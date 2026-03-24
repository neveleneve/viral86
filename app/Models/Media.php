<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {
    protected $fillable = [
        'directory',
        'caption',
        'source'
    ];

    public function contents() {
        return $this->hasMany(Content::class);
    }
}
