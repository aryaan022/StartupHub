<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Http\Requests\SendMessageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController
{
    /**
     * Get conversations
     */
    public function getConversations(): JsonResponse
    {
        $userId = auth()->user()->id;

        $conversations = Message::query()
            ->where(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                    ->orWhere('recipient_id', $userId);
            })
            ->with('sender', 'recipient')
            ->distinct('conversation_with')
            ->latest('created_at')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $conversations,
        ]);
    }

    /**
     * Get conversation with specific user
     */
    public function getConversation(string $userId): JsonResponse
    {
        $authUserId = auth()->user()->id;

        $messages = Message::query()
            ->where(function ($q) use ($authUserId, $userId) {
                $q->where('sender_id', $authUserId)->where('recipient_id', $userId)
                    ->orWhere('sender_id', $userId)->where('recipient_id', $authUserId);
            })
            ->with('sender', 'recipient')
            ->orderBy('created_at', 'asc')
            ->paginate(30);

        // Mark as read
        Message::where('recipient_id', $authUserId)
            ->where('sender_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'data' => $messages,
        ]);
    }

    /**
     * Send message
     */
    public function send(SendMessageRequest $request, string $recipientId): JsonResponse
    {
        $senderId = auth()->user()->id;

        $message = Message::create([
            'id' => Str::uuid(),
            'sender_id' => $senderId,
            'recipient_id' => $recipientId,
            'content' => $request->content,
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $message->load('sender', 'recipient'),
        ], 201);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(string $messageId): JsonResponse
    {
        $message = Message::findOrFail($messageId);

        if ($message->recipient_id !== auth()->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $message->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read',
        ]);
    }

    /**
     * Get unread count
     */
    public function getUnreadCount(): JsonResponse
    {
        $unreadCount = Message::where('recipient_id', auth()->user()->id)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,
            'unread_count' => $unreadCount,
        ]);
    }
}
