<?php

class Validator
{
    public $errors = [];
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function isLessThen($length)
    {
        if (strlen($this->value) > $length) {
            $this->errors[] = 'Too long!';
        }
        return $this; // it's main
    }

    public function isTrue()
    {
        if ($this->value !== true){
            $this->errors[] = 'Not a true!!!';
        }
        return $this; // it's main
    }
    public function isFalse()
    {
        if ($this->value !== false){
            $this->errors[] = 'Not a False!!!';
        }
        return $this;
    }
    public function isNumber()
    {
        if (is_int($this->value)){
            return $this;
        } else {
            $this->errors[] = 'Not a number!!!';
            return $this;
        }
    }
    public function isEmail()
    {
        if (filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return $this;
        } else {
            $this->errors[] = 'Not an email!!!';
            return $this;
        }
    }
    public function moreThen($b)
    {
        if(strlen($this->value) < $b) {
            $this->errors[] = "Less then";
            return $this;
        }
        return $this;
    }
    public function between($a, $b)
    {
        if($a < strlen($this->value) && strlen($this->value) < $b)
        {
            return $this;
        } else {
           return $this->errors[] = 'not between!!!';
        }
    }
    public function valid_symbols()
    {
        if(preg_match("/^[a-zA-Z0-9]+$/", $this->value) != 1) {
            $this->errors[] = "string isn't valid!!!";
            return $this;
        } else {
            return $this;
        }
    }
    public function str_compare($str)
    {
        if($this->value == $str){
            return $this;
        }   else {
            $this->errors[] = "isn't equal";
            return $this;
        }
    }
    public function isArray()
    {
        if(is_array($this->value) == true){
            return $this;
        } else {
            $this->errors[] = "isn't an array";
            return $this;
        }
    }
}
$v = new Validator('Hello');
$v->isLessThen(4)->moreThen(4)->isTrue()->isFalse()->isNumber()->isEmail()->between(4, 8)->valid_symbols()->str_compare("Hi")->isArray();
