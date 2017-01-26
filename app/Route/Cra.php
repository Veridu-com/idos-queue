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
 * CRA routing definitions.
 *
 * @link docs/cra/overview.md
 * @see App\Controller\Cra
 */
class Cra implements RouteInterface {
    /**
     * {@inheritdoc}
     */
    public static function getPublicNames() : array {
        return [
            'cra:tracesmart',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function register(App $app) {
        $container = $app->getContainer();

        $settings = $container->get('settings');
        if (empty($settings['daemons']['cra'])) {
            return;
        }

        $app->getContainer()[\App\Controller\Cra::class] = function (ContainerInterface $container) : ControllerInterface {
            return new \App\Controller\Cra(
                $container->get('commandBus'),
                $container->get('commandFactory')
            );
        };

        self::traceSmart($app, $settings['cra']);
    }

    /**
     * Schedules a TraceSmart verification.
     *
     * @param \Slim\App $app
     * @param array     $settings
     *
     * @return void
     */
    private static function traceSmart(App $app, array $settings) {
        $app
            ->post(
                '/cra/tracesmart',
                'App\Controller\Cra:traceSmart'
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
            ->setName('cra:traceSmart');
    }
}
