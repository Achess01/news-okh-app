<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
//setLocale(LC_TIME,'MX_es');

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
        'place',
        'event_date',
        'title',
        'user_id',
        'body',
        'status',
    ];

    public function reports()
    {
        return $this->hasMany(PostReport::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getEventDateFormattedAttribute()
    {
        return Carbon::parse($this->event_date)->isoFormat('dddd, D MMMM [de] Y[.] h:mm A');
    }
}
