<?php

namespace Database\Seeders;

use App\Function\Helper;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera tutti gli utenti dal database
        $users = User::all();

        // Numero totale di utenti
        $totalUsers = $users->count();

        $streets = config('citySeader.rome_streets');
        $latitudes = config('citySeader.lat');
        $longitudes = config('citySeader.long');

        for ($i=0; $i < 16; $i++) {
            $new_apartment = new Apartment();

            // Assegna l'appartamento a un utente in modo ciclico
            $user = $users[$i % $totalUsers];
            $new_apartment->user_id = $user->id;
            $new_apartment->image = 'path';
            $new_apartment->original_name = 'alt foto';
            $new_apartment->title = "Apartment Title numero $i";
            $new_apartment->slug = Helper::generateSlug($new_apartment->title, Apartment::class) ;
            $new_apartment->number_rooms = rand(1, 7);
            $new_apartment->number_beds = rand(1, 5);
            $new_apartment->number_bathrooms = rand(1, 3);
            $new_apartment->square_meters = rand(30, 200);
            $new_apartment->is_visible = true;
            $new_apartment->address = $streets[$i];
            $new_apartment->lat = $latitudes[$i];
            $new_apartment->lon = $longitudes[$i];

            // Salva il nuovo appartamento nel database
            $new_apartment->save();

        }
    }
}
