<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSeekerProfile extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'headline',
        'bio',
        'resume_url',
        'portfolio_url',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'years_experience',
        'current_job_title',
        'current_company',
        'education',
        'skills',
        'certifications',
        'is_open_to_opportunities',
        'preferred_job_types',
        'preferred_locations',
    ];

    protected $casts = [
        'education' => 'json',
        'skills' => 'json',
        'certifications' => 'json',
        'is_open_to_opportunities' => 'boolean',
        'preferred_job_types' => 'json',
        'preferred_locations' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
