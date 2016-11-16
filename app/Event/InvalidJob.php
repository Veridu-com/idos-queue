<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Event;

/**
 * Invalid Job event.
 */
class InvalidJob extends AbstractEvent {
    /**
     * Event related Job.
     *
     * @var mixed
     */
    public $job;

    /**
     * Class constructor.
     *
     * @param App\Command\Job $job
     *
     * @return void
     */
    public function __construct($job) {
        $this->job = $job;
    }
}
