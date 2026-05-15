<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Watchlist extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'investor_id',
        'startup_id',
        'notes',
    ];

    protected $casts = [
        'added_at' => 'datetime',
    ];

    public $timestamps = false;

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class);
    }

    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }
}
