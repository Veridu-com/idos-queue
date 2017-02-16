<?php

/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Handler;

use App\Command\AbstractCommand;
use App\Command\Sms\OTP;
use Interop\Container\ContainerInterface;
use Respect\Validation\Validator;

/**
 * Handles Sms commands.
 */
class Sms implements HandlerInterface {
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
            return new \App\Handler\Sms(
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
     * Sends OTP SMS.
     *
     * @param \App\Command\Sms\OTP $command
     *
     * @return bool
     */
    public function handleOTP(OTP $command) : bool {
        $smsData = [
            'template'  => 'otp',
            'phone'     => $command->phone,
            'variables' => [
                'password' => $command->password,
                'company'  => $command->company
            ]
        ];

        // Job Scheduling
        $task = $this->gearman->doBackground(
            'sms',
            json_encode($smsData),
            uniqid('sms-')
        );
        if ($this->gearman->returnCode() === \GEARMAN_SUCCESS) {
            // $this->emitter->emit(new JobScheduled($command, $task));

            return true;
        }

        // $this->emitter->emit(new ScheduleFailed($command, $this->gearman->error()));

        return false;
    }
}
