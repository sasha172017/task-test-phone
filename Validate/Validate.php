<?php


namespace Validate;


class Validate
{
    private $errors = [];

    public function setOneError($field,array $error){
        $this->errors[$field] = $error;
    }

    public function isValid(){
        return $this->errors ? false : true;
    }

    public function getError(){
        return $this->errors;
    }
}