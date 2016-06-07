<?php
/**
 * this source file is SmsAbstract.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 17-08
 */
namespace Bileji\Support\Sms;

use GuzzleHttp\Client;

abstract class SmsAbstract
{
    protected $code = 0;

    protected $content = '';

    public function post($uri, $options)
    {
        return (new Client())->request('POST', $uri, $options);
    }

    public function postAsync($uri, $options)
    {
        return (new Client())->requestAsync('POST' , $uri, $options);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getContent()
    {
        return $this->content;
    }
}