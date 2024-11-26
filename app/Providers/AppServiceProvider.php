<?php

namespace App\Providers;

use App\Repositories\Admin\Company\CompanyRepository;
use App\Repositories\Admin\Company\CompanyRepositoryInterface;
use App\Repositories\Admin\Country\CountryRepository;
use App\Repositories\Admin\Country\CountryRepositoryInterface;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\Admin\User\UserRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
