<?php

/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Handler;

use App\Command\AbstractCommand;
use App\Command\Cra\TraceSmart;
use Interop\Container\ContainerInterface;
use Respect\Validation\Validator;

/**
 * Handles Cra commands.
 */
class Cra implements HandlerInterface {
    /**
     * Gearman Client instance.
     *
     * @var \GearmanClient
     */
    protected $gearman;

    /**
     * {@inheritdoc}
     */
    public static function register(ContainerInterface $container) {
        $container[self::class] = function (ContainerInterface $container) {
            return new \App\Handler\Cra(
                $container
                    ->get('gearmanClient')
            );
        };
    }

    /**
     * Class constructor.
     *
     * @param \GearmanClient $gearmanClient
     *
     * @return void
     */
    public function __construct(\GearmanClient $gearmanClient) {
        $this->gearman = $gearmanClient;
    }

    /**
     * Schedules a TraceSmart verification.
     *
     * @param \App\Command\Cra\TraceSmart $command
     *
     * @return bool
     */
    public function handleTraceSmart(TraceSmart $command) : bool {
        $craData = [
            'provider'  => 'tracesmart',
            'publicKey' => $command->publicKey,
            'sourceId'  => $command->sourceId,
            'userName'  => $command->userName,
            'data'      => $command->data
        ];

        // Job Scheduling
        $task = $this->gearman->doBackground(
            'cra',
            json_encode($craData),
            uniqid('cra-')
        );
        if ($this->gearman->returnCode() === \GEARMAN_SUCCESS) {
            // $this->emitter->emit(new JobScheduled($command, $task));

            return true;
        }

        // $this->emitter->emit(new ScheduleFailed($command, $this->gearman->error()));

        return false;
    }
}
