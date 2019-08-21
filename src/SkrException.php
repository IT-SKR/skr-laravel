<?php

namespace Itskr\SkrLaravel;


class SkrException extends \Exception
{

    protected $message;
    protected $code;

    public function __construct(string $message, string $code = null)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function render()
    {
        return Skr::response($this->message, null, $this->code);
    }

}