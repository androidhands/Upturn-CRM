<?php

namespace Database\Seeders\Tenants;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['id' => '1','name' => 'Egypt','code' => 'EG','phoneCode' => '+20','flagUrl' => 'Flag/r5quSAeYCx9a8FWP/4pw6hBBkAt6Cn2km4jXcb1o35QcPexpoUxiVH5Jv.png','created_at' => '2024-11-19 23:35:43','updated_at' => '2024-11-23 10:59:42'],
            ['id' => '2','name' => 'Saudi Arabia','code' => 'SA','phoneCode' => '+966','flagUrl' => 'Flag/XrpFf9BpGFU72F0r/XA0WiauCjNzx3GidZ6jpgS5MSIAwiCjceVZb9t9p.jpg','created_at' => '2024-11-19 23:35:58','updated_at' => '2024-11-23 11:00:45']
          ];
          Country::insert($countries);
    }
}
