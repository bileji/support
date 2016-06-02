<?php
/**
 * this source file is Factory.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 10-36
 */
namespace Bileji\Support\Sms;

class Factory
{
    public function __construct($config = null)
    {
        empty($config['tactics']) && $config['tactics'] = 'single';

        switch ($config['tactics']) {
            case 'multi':
                $object = $this->multi($config['channel']);
                break;
            default:
                $object = $this->single($config['channel']);
                break;
        }

        return $this->object = $object;
    }

    public function get()
    {
        return $this->object;
    }

    private function multi(array $channels = [])
    {
        // 简易按权重分配
        $n = 0;
        $range_map = [];
        foreach ($channels as $channel => $config) {
            $weight = !empty($config['weight']) ? intval($config['weight']) : 0;
            array_map(function ($number) use ($range_map, $channel) {
                $range_map[$number] = $channel;
            }, range($n, $n += $weight));
        }

        $range = rand(0, $n);

        $single = ['channel' => $range_map[$range], 'config'  => $channels[$range_map[$range]]];

        $channel = __NAMESPACE__ . '\\' . $this->humpName($single['channel']);

        return new $channel($single['config']);
    }

    private function single(array $channels = [])
    {
        $single = [];
        // 先尝试寻找有没有设置默认的发送渠道
        foreach ($channels as $channel => $config) {
            if (!isset($config['default']) && $config['default'] == true) {
                $single = ['channel' => $channel, 'config'  => $config];
                break;
            }
        }

        // 没有默认发送渠道则取第一个
        if (empty($single)) {
            $single = $this->arrayFirst($channels, function ($channel, $config) {
                return ['channel' => $channel, 'config'  => $config];
            });
        }

        $channel = __NAMESPACE__ . '\\' . $this->humpName($single['channel']);

        return new $channel($single['config']);
    }

    private function arrayFirst(array $array, callable $callback = null)
    {
        foreach ($array as $key => $value) {
            return call_user_func($callback, $key, $value);
        }
        return [];
    }

    private function humpName($name)
    {
        array_map(function ($item) use (&$hump_name) {
            $hump_name .= ucfirst($item);
        }, explode('_', $name));
        return $hump_name;
    }
}