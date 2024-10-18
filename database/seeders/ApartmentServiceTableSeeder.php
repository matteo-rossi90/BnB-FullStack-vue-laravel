<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {

            $apartment = Apartment::inRandomOrder()->first();

            $service_id = Service::inRandomOrder()->first()->id;

            $apartment->services()->attach($service_id);
        }
    }
}
