<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    public function run(): void {
        $data = [
            ['name' => 'Nasional', 'slug' => 'nasional'],
            ['name' => 'Daerah', 'slug' => 'daerah'],
            ['name' => 'Internasional', 'slug' => 'internasional'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Tekno', 'slug' => 'tekno'],
            ['name' => 'Hiburan', 'slug' => 'hiburan'],
            ['name' => 'Gaya Hidup', 'slug' => 'gaya-hidup'],
            ['name' => 'Ekonomi Bisnis', 'slug' => 'ekonomi-bisnis'],
            ['name' => 'Politik & Hukum', 'slug' => 'politik-hukum'],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
