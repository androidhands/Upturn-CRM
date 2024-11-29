<?php

namespace App\Providers;

use App\Repositories\Admin\BusinessUnit\BusinessUnitRepository;
use App\Repositories\Admin\BusinessUnit\BusinessUnitRepositoryInterface;
use App\Repositories\Admin\Company\CompanyRepository;
use App\Repositories\Admin\Company\CompanyRepositoryInterface;
use App\Repositories\Admin\Country\CountryRepository;
use App\Repositories\Admin\Country\CountryRepositoryInterface;
use App\Repositories\Admin\Product\ProductRepository;
use App\Repositories\Admin\Product\ProductRepositoryInterface;
use App\Repositories\Admin\Region\RegionRepository;
use App\Repositories\Admin\Region\RegionRepositoryInterface;
use App\Repositories\Admin\Role\RoleRepository;
use App\Repositories\Admin\Role\RoleRepositoryInterface;
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
        $repositories = [
            'Country',
            'Company',
            'User',
            'Product',
            'Role',
            'BusinessUnit',
            'Region',
            'District',
            'Territory',
            'Line',
        ];
    
        foreach ($repositories as $repository) {
            $interface = "App\\Repositories\\Admin\\{$repository}\\{$repository}RepositoryInterface";
            $implementation = "App\\Repositories\\Admin\\{$repository}\\{$repository}Repository";
            $this->app->bind($interface, $implementation);
        }
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
