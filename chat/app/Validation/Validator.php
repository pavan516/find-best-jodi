<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

use Psr\Http\Message\ResponseInterface as Response;
 
use Psr\Http\Message\ServerRequestInterface as Request;


use App\Validation\Contracts\ValidatorInterface;

class Validator implements ValidatorInterface
{
    protected $errors;

    public function validate(Request $request,array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } 
            catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }
        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {

        return !empty($this->errors);
    }

    
}