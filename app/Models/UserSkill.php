<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSkill extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'skill_name',
        'proficiency_level',
        'years_of_experience',
        'endorsements_count',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;
    const UPDATED_AT = null;  // Only use created_at, not updated_at

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
