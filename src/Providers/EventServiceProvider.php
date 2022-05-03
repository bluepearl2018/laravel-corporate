<?php

namespace Eutranet\Corporate\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Eutranet\Frontend\Events\ArticleWasCreated;
use Eutranet\Frontend\Listeners\TellUsers;

class EventServiceProvider extends \App\Providers\EventServiceProvider
{
    protected $listen = [
        //
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
