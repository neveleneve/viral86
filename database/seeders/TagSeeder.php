<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder {
    public function run(): void {
        $data = [
            ['name' => 'Energi', 'slug' => 'energi'],
            ['name' => 'Regulasi', 'slug' => 'regulasi'],
            ['name' => '2026', 'slug' => '2026'],
        ];

        foreach ($data as $item) {
            Tag::create($item);
        }
    }
}
