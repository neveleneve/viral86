<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Media;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder {
    public function run(): void {
        $faker = \Faker\Factory::create('id_ID');

        $userIds = User::pluck('id');
        $categoryIds = Category::pluck('id');
        $mediaIds = Media::pluck('id');
        $tagIds = Tag::pluck('id');

        if ($categoryIds->isEmpty()) {
            $this->command->warn("Skip Seeding: Belum ada kategori di database!");
            return;
        }

        foreach (range(1, 20) as $index) {
            $title = $faker->sentence(10);

            $content = Content::create([
                'user_id'       => $userIds->random(),
                'category_id'   => $categoryIds->random(),
                'media_id'      => $mediaIds->isNotEmpty() ? $mediaIds->random() : null,
                'title'         => $title,
                'slug'          => Str::slug($title) . '-' . rand(100, 999),
                'excerpt'       => $faker->paragraph(2),
                'body'          => $this->generateFakeBody($faker),
                'status'        => $faker->randomElement(['published', 'draft']),
                'is_featured'   => $faker->boolean(20),
                'views'         => $faker->numberBetween(100, 5000),
                'published_at'  => now()->subDays(rand(0, 30)),
            ]);

            if ($tagIds->isNotEmpty()) {
                $content->tags()->attach(
                    $tagIds->random(rand(2, 3))
                );
            }
        }
    }

    private function generateFakeBody($faker) {
        $paragraphs = $faker->paragraphs(5);
        $body = "";
        foreach ($paragraphs as $p) {
            $body .= "<p class='mb-4'>{$p}</p>";
        }
        return $body;
    }
}
