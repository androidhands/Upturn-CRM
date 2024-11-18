<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RollbackTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollback-tenants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenants = Tenant::get();
        $tenants->each(function ($tenant) {
            TenantService::switchToTenant($tenant);
            $this->info('Start rollback: ' . $tenant->domain);
            $this->info('----------------------------------');
            Artisan::call(
                'migrate:rollback --path=database/migrations/tenants/ --database=tenant'
            );
            $this->info(Artisan::output());
        });
    }
}
