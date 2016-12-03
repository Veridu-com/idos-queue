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
 * E-mail routing definitions.
 *
 * @link docs/email/overview.md
 * @see App\Controller\Email
 */
class Email implements RouteInterface {
    /**
     * {@inheritdoc}
     */
    public static function getPublicNames() : array {
        return [
            'email:invitation',
            'email:otp',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function register(App $app) {
        $container = $app->getContainer();

        $settings = $container->get('settings');
        if (empty($settings['daemons']['email'])) {
            return;
        }

        $app->getContainer()[\App\Controller\Email::class] = function (ContainerInterface $container) : ControllerInterface {
            return new \App\Controller\Email(
                $container->get('commandBus'),
                $container->get('commandFactory')
            );
        };

        self::invitation($app, $settings['email']);
        self::otp($app, $settings['email']);
    }

    /**
     * Sends user invitation e-mail.
     *
     * @param \Slim\App $app
     * @param array     $settings
     *
     * @return void
     */
    private static function invitation(App $app, array $settings) {
        $app
            ->post(
                '/email/invitation',
                'App\Controller\Email:invitation'
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
            ->setName('email:invitation');
    }

    /**
     * Sends user an OTP check Email.
     *
     * @param \Slim\App $app
     * @param array     $settings
     *
     * @return void
     */
    private static function otp(App $app, array $settings) {
        $app
            ->post(
                '/email/otp',
                'App\Controller\Email:otp'
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
            ->setName('email:otp');
    }
}
