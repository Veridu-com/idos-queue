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
     * Asserts a valid or null token.
     *
     * @param mixed $token
     *
     * @throws \Respect\Validation\Exceptions\ExceptionInterface
     *
     * @return void
     */
    public function assertNullableToken($token) {
        Validator::oneOf(
            Validator::prnt(),
            Validator::nullType()
        )->assert($token);
    }
}
