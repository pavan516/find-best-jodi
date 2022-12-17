<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MatchException extends ValidationException
{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
        self:: STANDARD => '{{name}} must be matched',

        ],
    ];
}