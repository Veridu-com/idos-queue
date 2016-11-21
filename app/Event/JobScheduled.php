<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Event;

/**
 * Job Scheduled event.
 */
class JobScheduled extends AbstractEvent {
    /**
     * Event related Job.
     *
     * @var mixed
     */
    public $job;
    /**
     * Event related Gearman Task.
     *
     * @var \GearmanTask
     */
    public $task;

    /**
     * Class constructor.
     *
     * @param mixed        $job
     * @param \GearmanTask $task
     *
     * @return void
     */
    public function __construct($job, string $task) {
        $this->job  = $job;
        $this->task = $task;
    }
}
