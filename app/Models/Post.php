<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'slug',
        'place',
        'content',
        'published_at',
    ];

    public function reports()
    {
        return $this->hasMany(PostReport::class);
    }
}
