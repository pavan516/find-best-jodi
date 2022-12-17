<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class Activate
{

    public static function rules()
    {
    

        return [
                'email' => v::noWhitespace()->notEmpty()->email()->EmailExists()->length(1,100),
            ];
    }
}