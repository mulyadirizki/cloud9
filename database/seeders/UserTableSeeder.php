<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Mulyadi Rizki Putra',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'level' => '0',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Risky Firdaus',
                'username' => 'owner',
                'email' => 'owner@gmail.com',
                'level' => '1',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
