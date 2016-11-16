<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Validator\Traits;

use Respect\Validation\Validator;

/*
 * Key validation rules.
 */
trait Key {
    /**
     * Asserts a valid API Key.
     *
     * @param mixed $key
     *
     * @throws \Respect\Validation\Exceptions\ExceptionInterface
     *
     * @return void
     */
    public function assertKey($key) {
        Validator::regex('/[a-zA-Z0-9]+/')
            ->length(1, 32)
            ->assert($key);
    }
}
