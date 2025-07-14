<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'rating',
        'release_date',
        'director',
        'image_path'
    ];

    public function genres(){
        return $this->belongsToMany(Genre::class, 'movie_genres');
    }

    public function actors(){
        return $this->belongsToMany(Actor::class, 'movie_actors');
    }
}
