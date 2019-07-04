<?php


namespace Itskr\SkrLaravel\Facades;


use Illuminate\Support\Facades\Facade;

class Skr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'skr';
    }
}