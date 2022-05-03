<?php

namespace Eutranet\Corporate\Providers;

use Eutranet\Setup\Repository\BaseRepository;
use Eutranet\Corporate\Repository\Eloquent\AgencyRepository;
use Eutranet\Corporate\Repository\Eloquent\CorporateRepository;
use Eutranet\Corporate\Repository\Eloquent\StaffMemberRepository;
use Illuminate\Support\ServiceProvider;

class CorporateRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        $this->app->bind(BaseRepository::class, CorporateRepositoryServiceProvider::class);
        $this->app->bind(BaseRepository::class, AgencyRepository::class);
        $this->app->bind(BaseRepository::class, CorporateRepository::class);
        $this->app->bind(BaseRepository::class, StaffMemberRepository::class);
    }
}
