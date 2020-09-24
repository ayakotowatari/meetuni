<?php

namespace App\Providers;
use DB;
use Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 全てのSQLログを出力する.
        Schema::defaultStringLength(191);
        DB::listen(function ($query) {
            Log::debug(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }
}
