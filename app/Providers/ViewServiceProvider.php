<?php

namespace App\Providers;

use App\Http\ViewComposers\FooterComposer;
use App\Http\ViewComposers\HeaderComposer;
use App\Http\ViewComposers\SliderComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('blocks.slider', SliderComposer::class);
        View::composer('blocks.header', HeaderComposer::class);
        View::composer('blocks.footer', FooterComposer::class);
    }
}
