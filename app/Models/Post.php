<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use HasRichText;


    protected $richTextAttributes = [
        'body',
    ];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
