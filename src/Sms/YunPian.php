<?php
/**
 * this source file is YunPian.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 17-06
 */
namespace Bileji\Support\Sms;

use Closure;
use Mockery\CountValidator\Exception;

class YunPian extends SmsAbstract implements SmsInterface
{

    public function __construct($config)
    {
        $this->api_key = $config['api_key'];
        $this->single_send = 'https://sms.yunpian.com/v2/sms/single_send.json';
    }

    private function postOptions($phone, $message)
    {
        $options = ['form_params' => ['apikey' => $this->api_key, 'mobile' => $phone, 'text' => $message]];
        return $options;
    }

    public function send($phone, $message)
    {
        try {
            $this->content = $this->post($this->single_send, $this->postOptions($phone, $message))->getBody()->getContents();
        } catch (Exception $e) {
            $this->content = $e->getMessage();
        }

        $this->code = array_column(json_decode($this->content, true), 'code');

        return $this;
    }

    public function sendAsync($phone, $message, Closure $fulfilled_closure, Closure $rejected_closure = null)
    {
        return $this->postAsync($this->single_send, $this->postOptions($phone, $message))->then($fulfilled_closure, $rejected_closure);
    }
}