<?php
/**
 * this source file is SmsInterface.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 17-25
 */
namespace Bileji\Support\Sms;

use Closure;

Interface SmsInterface
{
    public function send($phone, $message);

    public function sendAsync($phone, $message, Closure $fulfilled_closure, Closure $rejected_closure);
}