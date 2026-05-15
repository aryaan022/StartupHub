<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Str;

/**
 * Service for managing user notifications
 */
class NotificationService
{
    /**
     * Create a notification
     */
    public static function notify(
        string $userId,
        string $type,
        string $title,
        ?string $description = null,
        ?string $relatedModel = null,
        ?string $relatedModelId = null
    ): Notification {
        return Notification::create([
            'id' => Str::uuid(),
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'related_model' => $relatedModel,
            'related_model_id' => $relatedModelId,
            'created_at' => now(),
        ]);
    }

    /**
     * Notify about new job application
     */
    public static function notifyNewApplication(string $founderId, string $startupId, string $applicationId): void
    {
        self::notify(
            $founderId,
            'application_received',
            'New job application received',
            'You have received a new application for one of your job postings.',
            'JobApplication',
            $applicationId
        );
    }

    /**
     * Notify about investment proposal
     */
    public static function notifyInvestmentProposal(string $founderId, string $investmentId): void
    {
        self::notify(
            $founderId,
            'investment_proposal',
            'New investment proposal',
            'An investor has submitted an investment proposal.',
            'Investment',
            $investmentId
        );
    }

    /**
     * Notify about new message
     */
    public static function notifyNewMessage(string $recipientId, string $senderId): void
    {
        self::notify(
            $recipientId,
            'new_message',
            'New message received',
            'You have a new message.',
            'User',
            $senderId
        );
    }

    /**
     * Get user unread notifications
     */
    public static function getUnreadNotifications(string $userId, int $limit = 20)
    {
        return Notification::where('user_id', $userId)
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Mark notification as read
     */
    public static function markAsRead(string $notificationId): void
    {
        Notification::find($notificationId)?->markAsRead();
    }
}
