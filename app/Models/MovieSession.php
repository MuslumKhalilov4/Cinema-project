<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'is_3d',
        'status',
        'movie_id',
        'hall_id',
        'language_id',
        'subtitle_id'
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function subtitle(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'subtitle_id');
    }
}
