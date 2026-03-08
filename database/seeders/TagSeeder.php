<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder {
    public function run(): void {
        $data = [
            ['name' => 'energi'],
            ['name' => 'regulasi'],
            ['name' => '2026'],
        ];

        foreach ($data as $item) {
            Tag::create($item);
        }
    }
}
