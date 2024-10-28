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
        $path = ['https://st3.idealista.it/news/archivie/styles/fullwidth_xl/public/2018-07/dl_a01034305.jpg?VersionId=xXq_fgAvfyggiimzBYqkMgObtAYnM8bq&itok=KHkn1er3', 'https://cdn.cosedicasa.com/wp-content/uploads/2020/06/soggiorno-e-cucina.jpg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUg8sHtUzF_eLr11HqWAmHKk0z4S71G_ZGsA&s', 'https://www.residenzadellasamaritana.it/img/appartamenti/moderni/2.jpg', 'https://www.appartamentipinidiroma.it/wp-content/uploads/2023/03/IMG_75471.jpg', 'https://www.nardiinterni.it/wp-content/uploads/2021/08/nardiinterni-casa04-120mq-totale-2000x1209.jpg', 'https://living.corriere.it/wp-content/uploads/2021/07/strato-appartamento-roma-foto-serena-eller-0247.jpg'];


        for ($i = 0; $i < count($streets) - 1; $i++) {
            $new_apartment = new Apartment();

            // Assegna l'appartamento a un utente in modo ciclico
            $user = $users[$i % $totalUsers];
            $new_apartment->user_id = $user->id;
            $new_apartment->image = $path[array_rand($path)];
            $new_apartment->original_name = 'alt foto';
            $new_apartment->title = "BnB da $user->name $i";
            $new_apartment->slug = Helper::generateSlug($new_apartment->title, Apartment::class);
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
