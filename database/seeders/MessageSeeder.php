<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = Apartment::all();

        $messagesData = [
            [
                'name' => 'Mario',
                'surname' => 'Rossi',
                'email' => 'mario.rossi@example.com',
                'text' => 'Buongiorno, vorrei avere maggiori informazioni sull\'appartamento.'
            ],
            [
                'name' => 'Giulia',
                'surname' => 'Bianchi',
                'email' => 'giulia.bianchi@example.com',
                'text' => 'Salve, è ancora disponibile l\'appartamento?'
            ],
            [
                'name' => 'Luca',
                'surname' => 'Verdi',
                'email' => 'luca.verdi@example.com',
                'text' => 'Sono interessato all\'affitto. Quando sarebbe possibile visitare l\'appartamento?'
            ],
            [
                'name' => 'Alessandro',
                'surname' => 'Neri',
                'email' => 'alessandro.neri@example.com',
                'text' => 'Vorrei prenotare una visita per vedere l\'appartamento. È possibile sabato mattina?'
            ]
        ];

        foreach ($apartments as $apartment){
            $randomMessages = collect($messagesData)->random(rand(1, 3));

            foreach ($randomMessages as $messageData) {
                $new_message = new Message();
                $new_message->apartment_id = $apartment->id;
                $new_message->name = $messageData['name'];
                $new_message->surname = $messageData['surname'];
                $new_message->email = $messageData['email'];
                $new_message->message = $messageData['text'];
                $new_message->save();
            }
        }


    }
}
