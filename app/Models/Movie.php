<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'release_date'];
    
    protected $casts = [
        'release_date' => 'date:Y-m-d', 
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre')->withPivot([]);
    }
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'movie_id');
    }
}
