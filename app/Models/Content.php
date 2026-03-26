<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Content extends Model {
    protected $fillable = [
        'user_id',
        'category_id',
        'media_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'status',
        'is_featured',
        'views',
        'published_at'
    ];

    protected $appends = ['reading_time'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function media() {
        return $this->belongsTo(Media::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    protected function readingTime(): Attribute {
        return Attribute::make(
            get: function () {
                if (!$this->body) return '1 Menit Baca';

                $cleanText = strip_tags($this->body);

                $wordCount = str_word_count($cleanText);

                $minutes = ceil($wordCount / 200);

                return $minutes . ' Menit Baca';
            }
        );
    }
}
