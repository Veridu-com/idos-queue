<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Command\Sms;

use App\Command\AbstractCommand;

/**
 * Sms "OTP" Command.
 */
class OTP extends AbstractCommand {
    /**
     * The phone number to send.
     *
     * @var string
     */
    public $phone;
    /**
     * The OTP password.
     *
     * @var int
     */
    public $password;
    /**
     * The OTP company.
     *
     * @var \stdClass
     */
    public $company;

    /**
     * {@inheritdoc}
     */
    public function setParameters(array $parameters) : self {
        if (isset($parameters['phone'])) {
            $this->phone = $parameters['phone'];
        }
        
        if (isset($parameters['password'])) {
            $this->password = $parameters['password'];
        }

        if (isset($parameters['company'])) {
            $this->company = $parameters['company'];
        }

        return $this;
    }
}
