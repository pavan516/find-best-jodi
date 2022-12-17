<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;




class Match extends AbstractRule
{
    protected $string_to_be_matched;
    
 
  
    public function __construct(string $string_to_be_matched)
    {
        $this->string_to_be_matched = $string_to_be_matched;
        
       
        
    }
    public function validate( $input)
    {
     
      if ($input == $this->string_to_be_matched) {
         return true;
      }
      return false;

    }


}