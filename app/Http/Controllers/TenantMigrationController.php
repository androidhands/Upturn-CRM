<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class TenantMigrationController extends Controller
{
    public function migrateTenants()
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            try {
                TenantService::switchToTenant($tenant);

                Log::info('Migrating tenant: ' . $tenant->domain);
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/tenants',
                    '--database' => 'tenant',
                    '--force' => true, // Ensure it runs in production
                ]);

                Log::info(Artisan::output());
            } catch (\Exception $e) {
                Log::error("Migration failed for tenant {$tenant->domain}: " . $e->getMessage());
                return response()->json([
                    'message' => "Migration failed for tenant {$tenant->domain}",
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        return response()->json(['message' => 'Migrations completed successfully']);
    }
}
