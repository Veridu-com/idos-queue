<?php

/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Route;

use App\Controller\ControllerInterface;
use Interop\Container\ContainerInterface;
use Slim\App;
use Slim\Middleware\HttpBasicAuthentication;

/**
 * SMS routing definitions.
 *
 * @link docs/sms/overview.md
 * @see App\Controller\Sms
 */
class Sms implements RouteInterface {
    /**
     * {@inheritdoc}
     */
    public static function getPublicNames() : array {
        return [
            'sms:otp',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function register(App $app) {
        $container = $app->getContainer();

        $settings = $container->get('settings');
        if (empty($settings['daemons']['sms'])) {
            return;
        }

        $app->getContainer()[\App\Controller\Sms::class] = function (ContainerInterface $container) : ControllerInterface {
            return new \App\Controller\Sms(
                $container->get('commandBus'),
                $container->get('commandFactory')
            );
        };

        self::otp($app, $settings['sms']);
    }

    /**
     * Sends user an OTP check SMS.
     *
     * @param \Slim\App $app
     * @param array     $settings
     *
     * @return void
     */
    private static function otp(App $app, array $settings) {
        $app
            ->post(
                '/sms/otp',
                'App\Controller\Sms:otp'
            )
            ->add(
                new HttpBasicAuthentication(
                    [
                        'users' => [
                            $settings['user'] => $settings['pass']
                        ],
                        'secure' => false
                    ]
                )
            )
            ->setName('sms:otp');
    }
}
