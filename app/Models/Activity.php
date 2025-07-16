<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'type',
        'distance_km',
        'steps',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getConvertedDistanceKmAttribute(): float
    {
        if ($this->type === 'walk' && $this->steps > 0) {
            return round($this->steps / 1500, 2);
        }

        return $this->distance_km;
    }
}
