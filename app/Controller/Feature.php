<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Controller;

use App\Factory\Command;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Router;

/**
 * Handles requests to /feature.
 */
class Feature implements ControllerInterface {
    /**
     * Router instance.
     *
     * @var \Slim\Router
     */
    private $router;
    /**
     * Command Bus instance.
     *
     * @var \League\Tactician\CommandBus
     */
    private $commandBus;
    /**
     * Command Factory instance.
     *
     * @var App\Factory\Command
     */
    private $commandFactory;

    /**
     * Class constructor.
     *
     * @param \Slim\Router                 $router
     * @param \League\Tactician\CommandBus $commandBus
     * @param App\Factory\Command          $commandFactory
     *
     * @return void
     */
    public function __construct(
        Router $router,
        CommandBus $commandBus,
        Command $commandFactory
    ) {
        $this->router         = $router;
        $this->commandBus     = $commandBus;
        $this->commandFactory = $commandFactory;
    }

    /**
     * Lists all available daemons.
     *
     * @apiEndpointResponse 200 schema/feature/listDaemons.json
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listDaemons(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface {
        // FIXME: not yet implemented!
        $body = [
            'data' => []
        ];

        $command = $this->commandFactory->create('ResponseDispatch');
        $command
            ->setParameter('request', $request)
            ->setParameter('response', $response)
            ->setParameter('body', $body);

        return $this->commandBus->handle($command);
    }

    /**
     * Schedules a new feature job.
     *
     * @apiEndpointResponse 201 schema/feature/scheduleJob.json
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @throws App\Execption\ScheduleFailed
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function scheduleJob(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface {
        $command = $this->commandFactory->create('Feature');
        $command->setParameters($request->getParsedBody());
        $this->commandBus->handle($command);

        $command = $this->commandFactory->create('ResponseDispatch');
        $command
            ->setParameter('request', $request)
            ->setParameter('response', $response)
            ->setParameter('statusCode', 201);

        return $this->commandBus->handle($command);
    }
}
