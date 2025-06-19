<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            ['name' => 'Montreal'],
            ['name' => 'Quebec City'],
            ['name' => 'Laval'],
            ['name' => 'Gatineau'],
            ['name' => 'Longueuil'],
            ['name' => 'Sherbrooke'],
            ['name' => 'Trois-Rivières'],
            ['name' => 'Saguenay'],
            ['name' => 'Saint-Jean-sur-Richelieu'],
            ['name' => 'Chicoutimi'],
            ['name' => 'Granby'],
            ['name' => 'Drummondville'],
            ['name' => 'Saint-Jérôme'],
            ['name' => 'Victoriaville'],
            ['name' => 'Sorel-Tracy'],
        ]);
    }
}
