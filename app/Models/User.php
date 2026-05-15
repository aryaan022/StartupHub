<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasUuids, Notifiable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'email',
        'phone',
        'password',
        'first_name',
        'last_name',
        'avatar_url',
        'bio',
        'role',
        'email_verified_at',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at'      => 'datetime',
        'is_active'              => 'boolean',
        'two_factor_verified_at' => 'datetime',
        'locked_until'           => 'datetime',
        'last_login_at'          => 'datetime',
    ];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function startup(): HasMany
    {
        return $this->hasMany(Startup::class, 'founder_id');
    }

    public function investorProfile(): HasMany
    {
        return $this->hasMany(Investor::class);
    }

    public function jobSeekerProfile(): HasMany
    {
        return $this->hasMany(JobSeekerProfile::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function hasPermission($permission): bool
    {
        $rolePermissions = config('permissions.roles.' . $this->role, []);
        return in_array($permission, $rolePermissions);
    }

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isFounder(): bool  { return $this->role === 'founder'; }
    public function isInvestor(): bool { return $this->role === 'investor'; }
    public function isJobSeeker(): bool { return $this->role === 'job_seeker'; }
}
