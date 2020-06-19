<?php

namespace App\Providers;

use App\CD;
use App\Lampiran;
use App\Observers\CDObserver;
use App\Observers\LampiranObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        // register SSO as singleton
        $this->app->singleton('App\Services\SSO', function ($app) {
            return new \App\Services\SSO($app->make('request'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Relation::morphMap([
            'cd_header' => 'App\CD',
            'cd_detail' => 'App\DetailCD',
            'sspcp_header' => 'App\SSPCP',
            'sspcp_detail' => 'App\DetailSSPCP',
            'kurs'  => 'App\Kurs'
        ]); */
        Schema::defaultStringLength(191);

        // register our observers here
        CD::observe(CDObserver::class);
        Lampiran::observe(LampiranObserver::class);
    }
}
