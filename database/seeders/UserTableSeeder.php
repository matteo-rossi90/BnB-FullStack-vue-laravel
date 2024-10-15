<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = ['Ludovico', 'Tommaso', 'Vincenzo', 'Matteo', 'Alessandra'];

        foreach($users as $user) {
            $new_user = new User();
            $new_user->name = $user;
            $new_user->email = $user . '@admin.com';
            $new_user->password = '12345678';
            $new_user->save();
        }
    }
}
