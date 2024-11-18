<?php

namespace Database\Seeders\tenants;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [

            ['name' => 'Egypt', 'phoneCode' => '+20', 'countryCode' =>
            'EG', 'flagUrl' => 'Flag_of_Egypt.png'],
            ['name' => 'Saudi Arabia', 'phoneCode' => '+966', 'countryCode' =>
            'SA', 'flagUrl' => 'Flag_of_Saudi_Arabia.png']
        ];
        Country::insert($countries);
    }
}
