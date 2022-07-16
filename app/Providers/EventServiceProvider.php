<?php

namespace App\Providers;

//use App\Http\Controllers\Api\UserController;
use App\Models\Product;
use App\Models\User;
use App\Observers\ProductObserver;
use App\Policies\UserPolicy;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        User::class => UserPolicy::class,
    ];
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
    }
}
