<?php

namespace App\Http\CustomValidators;

use Illuminate\Validation\Validator;

class IolValidator extends Validator {
	
    public function validateDateAfterOrEqual($attribute, $value, $parameters)
    {
    	foreach ($parameters as $parameter)
    		if (($this->getValue($parameter) !== null && $this->getValue($parameter) !== '') && (strtotime($value) < strtotime($this->getValue($parameter))))
    			return false;
    	return true;
    }

    public function validateDateBeforeOrEqual($attribute, $value, $parameters)
    {
    	foreach ($parameters as $parameter)
    		if (($this->getValue($parameter) !== null && $this->getValue($parameter) !== '') && (strtotime($value) > strtotime($this->getValue($parameter))))
    			return false;
    	return true;
    }

}
