<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Event;

/**
 * Schedule Failed event.
 */
class ScheduleFailed extends AbstractEvent {
    /**
     * Event related Job.
     *
     * @var mixed
     */
    public $job;
    /**
     * Event related Message.
     *
     * @var string
     */
    public $message;

    /**
     * Class constructor.
     *
     * @param mixed $job
     *
     * @return void
     */
    public function __construct($job, string $message) {
        $this->job     = $job;
        $this->message = $message;
    }
}
