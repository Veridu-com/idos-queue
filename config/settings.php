<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

use App\Helper\Env;

if (! defined('__VERSION__')) {
    define('__VERSION__', Env::asString('IDOS_VERSION', '1.0'));
}

$appSettings = [
    'debug'                             => Env::asBool('IDOS_DEBUG', false),
    'displayErrorDetails'               => Env::asBool('IDOS_DEBUG', false),
    'determineRouteBeforeAppMiddleware' => true,
    'log'                               => [
        'path' => Env::asString(
            'IDOS_LOG_FILE',
            sprintf(
                '%s/../log/queue.log',
                __DIR__
            )
        ),
        'level' => Monolog\Logger::DEBUG
    ],
    'gearman' => [
        'timeout' => 1000,
        'servers' => Env::asString('IDOS_GEARMAN_SERVERS', 'localhost:4730')
    ],
    'daemons' => [
        'scrape'  => true,
        'feature' => true,
        'email'   => true
    ],
    'scrape' => [
        'user'      => Env::asString('IDOS_SCRAPE_USER', '***REMOVED***'),
        'pass'      => Env::asString('IDOS_SCRAPE_PASS', '***REMOVED***')
    ],
    'feature' => [
        'user'      => Env::asString('IDOS_FEATURE_USER', '***REMOVED***'),
        'pass'      => Env::asString('IDOS_FEATURE_PASS', '***REMOVED***')
    ],
    'email' => [
        'user'      => Env::asString('IDOS_EMAIL_USER', '***REMOVED***'),
        'pass'      => Env::asString('IDOS_EMAIL_PASS', '***REMOVED***')
    ]
];
