<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class SignUp
{

    public static function rules($request)
    {
    
        $password = $request->getParam('password');

        return [
                'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable()->length(1,100),
                'first_name' => v::notEmpty()->alpha()->length(1,50),
                'password' => v::notEmpty()->length(8,20),
                'confirm_password' => v::notEmpty()->Match($password),
                'username' => v::notEmpty()->length(8,20)->noWhitespace()->usernameAvailable(),
            ];
    }
}