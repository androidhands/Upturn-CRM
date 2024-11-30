<?php

namespace Database\Seeders\Tenants;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       
        $names = [
            ['country_id' => 1,'name' => 'Algharbia'],
            ['country_id' => 1,'name' => 'Cairo'],
            ['country_id' => 1,'name' => 'Menoufia'],
            ['country_id' => 1,'name' => 'Giza'],
            ['country_id' => 1,'name' => 'Dakahlia'],
            ['country_id' => 1,'name' => 'Asyut'],
            ['country_id' => 1,'name' => 'Matrouh'],
            ['country_id' => 1,'name' => 'Alsharqia'],
            ['country_id' => 1,'name' => 'Qalyubia'],
            ['country_id' => 1,'name' => 'Bani Sweif'],
            ['country_id' => 1,'name' => 'Kafr El Sheikh'],
            ['country_id' => 1,'name' => 'Qena'],
            ['country_id' => 1,'name' => 'Minya'],
            ['country_id' => 1,'name' => 'Port Said'],
            ['country_id' => 1,'name' => 'Aswan'],
            ['country_id' => 1,'name' => 'Alexandria'],
            ['country_id' => 1,'name' => 'Beheira'],
            ['country_id' => 1,'name' => 'Ismailia'],
            ['country_id' => 1,'name' => 'Damietta'],
            ['country_id' => 1,'name' => 'Sohag'],
            ['country_id' => 1,'name' => 'Fayoum'],
            ['country_id' => 1,'name' => 'North Sinai'],
            ['country_id' => 1,'name' => 'Luxor'],
            ['country_id' => 1,'name' => 'New Valley Governorate'],
            ['country_id' => 1,'name' => 'Suez'],
            ['country_id' => 1,'name' => 'Red Sea'],
            ['country_id' => 2,'name' => 'Riyadh'],
            ['country_id' => 2,'name' => 'Makkah'],
            ['country_id' => 2,'name' => 'AL Madinah AL Munawwarah'],
            ['country_id' => 2,'name' => 'Al-Qassim'],
            ['country_id' => 2,'name' => 'Eastern'],
            ['country_id' => 2,'name' => 'difficult'],
            ['country_id' => 2,'name' => 'Tabuk'],
            ['country_id' => 2,'name' => 'Hail'],
            ['country_id' => 2,'name' => 'Northern borders'],
            ['country_id' => 2,'name' => 'Jazan'],
            ['country_id' => 2,'name' => 'Najran'],
            ['country_id' => 2,'name' => 'Al-Baha'],
            ['country_id' => 2,'name' => 'Hollow']
          ];
        Governorate::insert($names);
          
    }
}
