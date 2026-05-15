<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasUuids, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'job_id',
        'applicant_id',
        'startup_id',
        'resume_url',
        'cover_letter',
        'portfolio_url',
        'status',
        'rating',
        'notes',
        'interviewed_at',
    ];

    protected $casts = [
        'interviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }

    /**
     * Get readable status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'applied' => 'Applied',
            'viewed' => 'Viewed',
            'shortlisted' => 'Shortlisted',
            'rejected' => 'Rejected',
            'accepted' => 'Accepted',
            'withdrawn' => 'Withdrawn',
            default => 'Unknown'
        };
    }
}
