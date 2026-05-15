<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Str;

/**
 * Service for logging user activities for audit trail and security
 */
class ActivityLogService
{
    /**
     * Log an activity
     */
    public static function log(
        string $action,
        ?string $modelType = null,
        ?string $modelId = null,
        ?array $changes = null
    ): void {
        ActivityLog::create([
            'id' => Str::uuid(),
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'changes' => $changes,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }

    /**
     * Get user activity logs
     */
    public static function getUserLogs(string $userId, int $limit = 50)
    {
        return ActivityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get model activity logs
     */
    public static function getModelLogs(string $modelType, string $modelId, int $limit = 50)
    {
        return ActivityLog::where('model_type', $modelType)
            ->where('model_id', $modelId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
