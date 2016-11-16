<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Validator\Traits;

use Respect\Validation\Validator;

/*
 * UserName validation rules.
 */
trait UserName {
    /**
     * Asserts a valid name, 1-50 chars long, alpha numeric, no white spaces.
     *
     * @param mixed $userName
     *
     * @throws \Respect\Validation\Exceptions\ExceptionInterface
     *
     * @return void
     */
    public function assertUserName($userName) {
        Validator::alnum()
            ->noWhitespace()
            ->length(1, 50)
            ->assert($userName);
    }
}
