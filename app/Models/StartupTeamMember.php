<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StartupTeamMember extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'startup_id',
        'user_id',
        'name',
        'position',
        'bio',
        'avatar_url',
        'email',
        'linkedin_url',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
