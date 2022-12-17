<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class OAuthRegister
{

    public static function rules($request)
    {
    
        $password = $request->getParam('password');

        return [
                'password' => v::notEmpty()->length(8,20),
                'confirm_password' => v::notEmpty()->Match($password),
                'username' => v::notEmpty()->length(8,20)->noWhitespace()->usernameAvailable(),
            ];
    }
}