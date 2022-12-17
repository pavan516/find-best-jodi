<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class SignIn
{

    public static function rules($request)
    {
    

        return [
                'username' => v::notEmpty()->noWhitespace(),
                'password' => v::notEmpty(),
            ];
    }
}