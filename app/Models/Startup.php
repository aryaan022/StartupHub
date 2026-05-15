<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;

/**
 * Startup Model
 * 
 * Represents a startup/company in the platform
 */
class Startup extends Model
{
    use HasUuids, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'founder_id',
        'name',
        'slug',
        'logo_url',
        'banner_url',
        'description',
        'short_description',
        'website_url',
        'founded_at',
        'industry',
        'sub_industry',
        'country',
        'city',
        'stage',
        'funding_goal',
        'total_raised',
        'team_size',
        'is_hiring',
        'is_verified',
        'visibility',
        'view_count',
    ];

    protected $casts = [
        'is_hiring' => 'boolean',
        'is_verified' => 'boolean',
        'founded_at' => 'date',
        'funding_goal' => 'decimal:2',
        'total_raised' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['profile_completion_percentage'];

    /**
     * Get the founder of this startup
     */
    public function founder()
    {
        return $this->belongsTo(User::class, 'founder_id');
    }

    /**
     * Get the startup profile details
     */
    public function profile()
    {
        return $this->hasOne(StartupProfile::class);
    }

    /**
     * Get team members
     */
    public function teamMembers(): HasMany
    {
        return $this->hasMany(StartupTeamMember::class);
    }

    /**
     * Get jobs posted by this startup
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Get applications for this startup's jobs
     */
    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * Get investments received
     */
    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get investors who have invested
     */
    public function investors(): BelongsToMany
    {
        return $this->belongsToMany(Investor::class, 'investments')
            ->withPivot('amount', 'investment_type', 'status', 'invested_at')
            ->withTimestamps();
    }

    /**
     * Calculate profile completion percentage
     */
    public function getProfileCompletionPercentageAttribute(): int
    {
        $fields = [
            'name' => $this->name ? 10 : 0,
            'description' => $this->description ? 15 : 0,
            'logo_url' => $this->logo_url ? 10 : 0,
            'website_url' => $this->website_url ? 10 : 0,
            'industry' => $this->industry ? 10 : 0,
            'stage' => $this->stage ? 10 : 0,
            'team_size' => $this->team_size ? 10 : 0,
            'profile' => $this->profile ? 15 : 0,
        ];

        return array_sum($fields);
    }

    /**
     * Get startup statistics
     */
    public function getStats()
    {
        return [
            'total_jobs_posted' => $this->jobs()->count(),
            'active_jobs' => $this->jobs()->where('is_active', true)->count(),
            'total_applications' => $this->applications()->count(),
            'total_invested' => $this->total_raised,
            'investors_count' => $this->investors()->count(),
            'team_size' => $this->team_size,
            'profile_views' => $this->view_count,
        ];
    }
}
