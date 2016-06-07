<?php
/**
 * this source file is AsyncServiceProvider.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-07 15-10
 */
namespace Bileji\Support;

use Bileji\Support\Async\Async;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;

class AsyncServiceProvider extends ServiceProvider
{
    const VERSION = "1.0.0";

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__).'/config/gearman.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('gearman.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('gearman');
        }
        $this->mergeConfigFrom($source, 'gearman');
    }

    /**
     * 取得提供者所提供的服务。
     *
     * @return array
     */
    public function register()
    {
        $this->app->singleton('gearman', function () {
            return new Async();
        });
    }
}