<?php
/**
 * Created by PhpStorm.
 * User: lw540
 * Date: 2019/2/4
 * Time: 15:23
 */

namespace App\Exceptions;


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
            return hfas_response($this->message);
        }
        return hfas_response($this->message,[],$this->code);
    }

}