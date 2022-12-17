<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class RecoverPassword
{

    public static function rules($request)
    {
        $password = $request->getParam('password');

        return [
                'email' => v::noWhitespace()->notEmpty()->email()->EmailExists()->length(1,100),
                'request_code' => v::noWhitespace()->notEmpty()->digit()->length(1,6),
                'password' => v::notEmpty()->length(8,20),
                'confirm_password' => v::notEmpty()->Match($password),
            ];
    }
}