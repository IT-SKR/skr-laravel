<?php
/**
 * Created by PhpStorm.
 * User: lw540
 * Date: 2019/6/27
 * Time: 10:57
 */

namespace Itskr\SkrLaravel\Facades;


use Illuminate\Support\Facades\Facade;

class Skr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'skr';
    }
}