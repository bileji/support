<?php
/**
 * this source file is Async.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-07 15-09
 */
namespace Bileji\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Async extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "async";
    }
}