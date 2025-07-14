<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'birth_date',
        'nationality',
        'height',
        'image_path'
    ];

    public function movies(){
        return $this->belongsToMany(Movie::class, 'movie_actors');
    }
}
