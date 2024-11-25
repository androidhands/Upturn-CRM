<?php

namespace App\Providers;

use App\Repositories\Admin\Company\CompanyRepository;
use App\Repositories\Admin\Company\CompanyRepositoryInterface;
use App\Repositories\Admin\Country\CountryRepository;
use App\Repositories\Admin\Country\CountryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
