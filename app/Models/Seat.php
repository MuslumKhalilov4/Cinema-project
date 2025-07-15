<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'number',
        'is_reserved'
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
