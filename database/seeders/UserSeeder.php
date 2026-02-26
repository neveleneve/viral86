<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run(): void {
        $data = [
            [
                'name' => 'Administrator',
                'username' => 'administrator',
                'email' => 'administrator@viral86.online',
                'password' => bcrypt('password')
            ],
        ];

        foreach ($data as $item) {
            User::create($item);
        }
    }
}
