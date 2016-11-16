<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Event;

/**
 * Job Received event.
 */
class JobReceived extends AbstractEvent {
    /**
     * Event related Job.
     *
     * @var mixed
     */
    public $job;

    /**
     * Class constructor.
     *
     * @param mixed $job
     *
     * @return void
     */
    public function __construct($job) {
        $this->job = $job;
    }
}
