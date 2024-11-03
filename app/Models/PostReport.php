<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    /** @use HasFactory<\Database\Factories\PostReportFactory> */
    use HasFactory;

    protected $dates = ['reported_at'];

    // Agregar los campos que se pueden asignar masivamente
    protected $fillable = [
        'post_id',
        'user_id',
        'reported_reason',
        'reported_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getReportedAtFormattedAttribute()
    {
        return Carbon::parse($this->reported_at)->diffForHumans();
    }
}
