<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investor extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_logo_url',
        'company_description',
        'investment_range_min',
        'investment_range_max',
        'industries',
        'stages',
        'countries',
        'portfolio_size',
        'total_invested',
        'website_url',
        'verified',
    ];

    protected $casts = [
        'industries' => 'json',
        'stages' => 'json',
        'countries' => 'json',
        'verified' => 'boolean',
        'investment_range_min' => 'decimal:2',
        'investment_range_max' => 'decimal:2',
        'total_invested' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function watchlist(): HasMany
    {
        return $this->hasMany(Watchlist::class);
    }
}
