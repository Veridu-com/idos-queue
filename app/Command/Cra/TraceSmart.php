<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Command\Cra;

use App\Command\AbstractCommand;

/**
 * Cra "TraceSmart" Command.
 */
class TraceSmart extends AbstractCommand {
    /**
     * The credential public key.
     *
     * @var string
     */
    public $publicKey;
    /**
     * The source id.
     *
     * @var int
     */
    public $sourceId;
    /**
     * The user userName.
     *
     * @var string
     */
    public $userName;
    /**
     * The CRA data.
     *
     * @var array
     */
    public $data;

    /**
     * {@inheritdoc}
     */
    public function setParameters(array $parameters) : self {
        if (isset($parameters['publicKey'])) {
            $this->publicKey = $parameters['publicKey'];
        }
        
        if (isset($parameters['sourceId'])) {
            $this->sourceId = $parameters['sourceId'];
        }

        if (isset($parameters['userName'])) {
            $this->userName = $parameters['userName'];
        }

        if (isset($parameters['data'])) {
            $this->data = $parameters['data'];
        }

        return $this;
    }
}
