<?php
/**
 * this source file is Sms.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 10-42
 */
namespace Bileji\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "sms";
    }
}