<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start = strtotime("2023-01-01 00:00:00");
        $end = strtotime("2024-10-28 17:45:33");
        for ($i=0; $i < 100; $i++) {
            $new_view = new View;
            $new_view->apartment_id = Apartment::inRandomOrder()->first()->id;
            $new_view->IP_address = Hash::make('192.168.54.12');
            $randomTimestamp = rand($start, $end);
            $new_view->date_view =  date("Y-m-d H:i:s", $randomTimestamp);
            $new_view->save();
        }
    }
}
