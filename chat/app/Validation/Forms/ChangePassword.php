<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class ChangePassword
{

    public static function rules($request)
    {
    
        $password = $request->getParam('password');

        return [
                'current_password' => v::notEmpty(),
                'password' => v::notEmpty()->length(8,20),
                'confirm_password' => v::notEmpty()->Match($password),
            ];
    }
}