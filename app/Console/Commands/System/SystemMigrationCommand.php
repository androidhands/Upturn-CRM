<?php

namespace App\Console\Commands\System;

use Illuminate\Console\Command;
use App\Services\TenantService;
use Illuminate\Support\Facades\Artisan;
use App\Models\Tenant;

class SystemMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'System Migration';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        Artisan::call(
            'migrate --path=database/migrations/system/ --database=system'
        );
        $this->info(Artisan::output());
    }
}
