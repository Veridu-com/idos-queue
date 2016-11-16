<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Command;

/**
 * Feature Command.
 */
class Feature extends AbstractCommand {
    /**
     * Username.
     *
     * @var string
     */
    public $userName;
    /**
     * Source Id.
     *
     * @var int
     */
    public $sourceId;
    /**
     * Process Id.
     *
     * @var int
     */
    public $processId;
    /**
     * Credential's Public Key.
     *
     * @var string
     */
    public $publicKey;
    /**
     * Provider name.
     *
     * @var string
     */
    public $providerName;

    /**
     * {@inheritdoc}
     */
    public function setParameters(array $parameters) : self {
        if (isset($parameters['userName'])) {
            $this->userName = $parameters['userName'];
        }

        if (isset($parameters['sourceId'])) {
            $this->sourceId = $parameters['sourceId'];
        }

        if (isset($parameters['processId'])) {
            $this->processId = $parameters['processId'];
        }

        if (isset($parameters['publicKey'])) {
            $this->publicKey = $parameters['publicKey'];
        }

        if (isset($parameters['providerName'])) {
            $this->providerName = $parameters['providerName'];
        }

        return $this;
    }
}
