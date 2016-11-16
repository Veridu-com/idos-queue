<?php
/*
 * Copyright (c) 2012-2016 Veridu Ltd <https://veridu.com>
 * All rights reserved.
 */

declare(strict_types = 1);

namespace App\Validator;

/**
 * Feature Validation Rules.
 */
class Feature implements ValidatorInterface {
    use Traits\UserName,
        Traits\Id,
        Traits\Name,
        Traits\Key;
}
