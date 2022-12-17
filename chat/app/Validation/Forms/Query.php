<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class Query
{

    public static function rules()
    {
        return [
                'email' => v::noWhitespace()->notEmpty()->email()->length(1,100),
                'fullname' => v::notEmpty()->alpha()->length(1,50),
                'query' => v::notEmpty()->length(8,500),
            ];
    }
}