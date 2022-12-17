<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class ChangeProfile
{

    public static function rules()
    {
    

        return [
                'first_name' => v::notEmpty()->alpha()->length(1,50),
                'last_name' => v::optional(v::notEmpty()->alpha()->length(1,50)),
                'username' => v::notEmpty()->length(8,20)->noWhitespace()->usernameAvailable(),
            ];
    }
}