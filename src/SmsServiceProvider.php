<?php
/**
 * this source file is SmsServiceProvider.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 10-18
 */
namespace Bileji\Support;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;

class Test
{
    public function hello()
    {
        return "hello world you";
    }
}

class SmsServiceProvider extends ServiceProvider
{
    const VERSION = "1.0.0";

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function boot()
    {
         $source = dirname(__DIR__).'/config/sms.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('sms.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('sms');
        }
        $this->mergeConfigFrom($source, 'sms');
    }

    /**
     * 取得提供者所提供的服务。
     *
     * @return array
     */
    public function register()
    {
        $this->app->singleton('sms', function () {
            return new Test();
        });
    }
}