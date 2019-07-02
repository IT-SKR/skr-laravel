<?php

namespace Itskr\SkrLaravel;


class SkrException extends \Exception
{

    protected $message;
    protected $code;

    public function __construct(string $message,string $code='')
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function render(){
        if (empty($this->code)){
            return Skr::response($this->message);
        }
        return Skr::response($this->message,null,$this->code);
    }

}