<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'title', 'content'];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
