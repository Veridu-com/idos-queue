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

/**
 * Feature routing definitions.
 *
 * @link docs/feature/overview.md
 * @see App\Controller\Feature
 */
class Feature implements RouteInterface {
    /**
     * {@inheritdoc}
     */
    public static function getPublicNames() : array {
        return [
            'feature:listDaemons',
            'feature:scheduleJob'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function register(App $app) {
        $container = $app->getContainer();

        $settings = $container->get('settings');
        if (empty($settings['daemons']['feature'])) {
            return;
        }

        $app->getContainer()[\App\Controller\Feature::class] = function (ContainerInterface $container) : ControllerInterface {
            return new \App\Controller\Feature(
                $container->get('router'),
                $container->get('commandBus'),
                $container->get('commandFactory')
            );
        };

        self::listDaemons($app);
        self::scheduleJob($app);
    }

    /**
     * List all Daemons.
     *
     * Lists all currently available daemons.
     *
     * @apiEndpoint GET /feature
     * @apiGroup Feature
     *
     * @param \Slim\App $app
     *
     * @return void
     *
     * @link docs/feature/listDaemons.md
     * @see App\Controller\Feature::listDaemons
     */
    private static function listDaemons(App $app) {
        $app
            ->get(
                '/feature',
                'App\Controller\Feature:listDaemons'
            )
            ->setName('feature:listDaemons');
    }

    /**
     * Job Schedule Endpoint.
     *
     * Schedules a new feature job.
     *
     * @apiEndpoint POST /feature
     * @apiGroup Feature
     *
     * @param \Slim\App $app
     *
     * @return void
     *
     * @link docs/feature/scheduleJob.md
     * @see App\Controller\Feature::scheduleJob
     */
    private static function scheduleJob(App $app) {
        $app
            ->post(
                '/feature',
                'App\Controller\Feature:scheduleJob'
            )
            ->setName('feature:scheduleJob');
    }
}
