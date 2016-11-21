<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Handler;

use App\Command\Feature as FeatureCommand;
use App\Event\InvalidJob;
use App\Event\JobReceived;
use App\Event\JobScheduled;
use App\Event\ScheduleFailed;
use App\Exception\AppException;
use App\Validator\Feature as FeatureValidator;
use Interop\Container\ContainerInterface;
use League\Event\Emitter;

/**
 * Handles Feature commands.
 */
class Feature implements HandlerInterface {
    /**
     * Gearman Client instance.
     *
     * @var \GearmanClient
     */
    protected $gearman;
    /**
     * Feature Validator instance.
     *
     * @var App\Validator\Feature
     */
    protected $validator;
    /**
     * Event emitter instance.
     *
     * @var \League\Event\Emitter
     */
    protected $emitter;

    /**
     * {@inheritdoc}
     */
    public static function register(ContainerInterface $container) {
        $container[self::class] = function (ContainerInterface $container) : HandlerInterface {
            return new \App\Handler\Feature(
                $container
                    ->get('gearmanClient'),
                $container
                    ->get('validatorFactory')
                    ->create('Feature'),
                $container
                    ->get('eventEmitter')
            );
        };
    }

    /**
     * Class constructor.
     *
     * @param \GearmanClient        $gearmanClient
     * @param App\Validator\Feature $validator
     * @param \League\Event\Emitter $emitter
     *
     * @return void
     */
    public function __construct(
        \GearmanClient $gearmanClient,
        FeatureValidator $validator,
        Emitter $emitter
    ) {
        $this->gearman   = $gearmanClient;
        $this->validator = $validator;
        $this->emitter   = $emitter;
    }

    /**
     * Handles Job scheduling.
     *
     * @param App\Command\Feature $command
     *
     * @return void
     */
    public function handleFeature(FeatureCommand $command) {
        try {
            // Job validation
            $this->validator->assertUserName($command->userName);
            $this->validator->assertId($command->sourceId);
            $this->validator->assertId($command->processId);
            $this->validator->assertName($command->providerName);
            $this->validator->assertKey($command->publicKey);
        } catch (\Respect\Validation\Exceptions\ExceptionInterface $exception) {
            $this->emitter->emit(new InvalidJob($command));
            throw new AppException(
                sprintf(
                    'Invalid input: %s',
                    implode('; ', $exception->getMessages())
                ),
                400
            );
        }

        $this->emitter->emit(new JobReceived($command));

        // Job Scheduling
        $task = $this->gearman->doBackground(
            'feature',
            json_encode($command)
        );
        if ($this->gearman->returnCode() === \GEARMAN_SUCCESS) {
            $this->emitter->emit(new JobScheduled($command, $task));

            return;
        }

        $this->emitter->emit(new ScheduleFailed($command, $this->gearman->error()));
    }
}
