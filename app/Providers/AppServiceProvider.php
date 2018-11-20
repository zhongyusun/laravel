<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //解决php版本过低
        Schema::defaultStringLength(191);
        //Carbon 中文时间
        Carbon::setLocale('zh');
        /*******注册观察者****/
        User::observe(UserObserver::class);
        /****注册观察者******/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
