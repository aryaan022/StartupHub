<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StartupProfile extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'startup_id',
        'pitch_deck_url',
        'video_pitch_url',
        'story',
        'achievements',
        'social_twitter',
        'social_linkedin',
        'social_github',
        'social_instagram',
        'monthly_revenue',
        'mrr_growth_rate',
        'active_users',
        'customer_count',
        'employees_count',
    ];

    protected $casts = [
        'monthly_revenue' => 'decimal:2',
        'mrr_growth_rate' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }
}
