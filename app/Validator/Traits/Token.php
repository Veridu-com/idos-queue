<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Validator\Traits;

use Respect\Validation\Validator;

/*
 * Token validation rules.
 */
trait Token {
    /**
     * Asserts a valid token.
     *
     * @param mixed $token
     *
     * @throws \Respect\Validation\Exceptions\ExceptionInterface
     *
     * @return void
     */
    public function assertToken($token) {
        Validator::prnt()
            ->assert($token);
    }

    /**
     * Asserts a valid token (optional).
     *
     * @param mixed $token
     *
     * @throws \Respect\Validation\Exceptions\ExceptionInterface
     *
     * @return void
     */
    public function assertOptionalToken($token) {
        Validator::optional(
            Validator::prnt()
        )->assert($token);
    }
}
