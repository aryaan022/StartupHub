<?php

namespace App\Http\Controllers\Api;

use App\Models\Investor;
use App\Models\Investment;
use App\Models\Watchlist;
use App\Http\Requests\UpdateInvestorProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvestorController
{
    /**
     * Get investor profile
     */
    public function getProfile(): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $investor,
        ]);
    }

    /**
     * Update investor profile
     */
    public function updateProfile(UpdateInvestorProfileRequest $request): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        $investor->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $investor,
        ]);
    }

    /**
     * Get watchlist
     */
    public function getWatchlist(): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        $watchlist = Watchlist::where('investor_id', $investor->id)
            ->with('startup')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $watchlist,
        ]);
    }

    /**
     * Add to watchlist
     */
    public function addToWatchlist(string $startupId): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        $existing = Watchlist::where('investor_id', $investor->id)
            ->where('startup_id', $startupId)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Already in watchlist',
            ], 409);
        }

        $watchlist = Watchlist::create([
            'id' => Str::uuid(),
            'investor_id' => $investor->id,
            'startup_id' => $startupId,
            'added_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Added to watchlist',
            'data' => $watchlist,
        ], 201);
    }

    /**
     * Remove from watchlist
     */
    public function removeFromWatchlist(string $startupId): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        Watchlist::where('investor_id', $investor->id)
            ->where('startup_id', $startupId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from watchlist',
        ]);
    }

    /**
     * Get investments
     */
    public function getInvestments(): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        $investments = Investment::where('investor_id', $investor->id)
            ->with('startup')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $investments,
        ]);
    }

    /**
     * Create investment
     */
    public function createInvestment(Request $request, string $startupId): JsonResponse
    {
        $investor = auth()->user()->investorProfile()->firstOrFail();

        $investment = Investment::create([
            'id' => Str::uuid(),
            'startup_id' => $startupId,
            'investor_id' => $investor->id,
            'amount' => $request->amount,
            'investment_type' => $request->investment_type,
            'equity_percentage' => $request->equity_percentage,
            'status' => 'proposed',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Investment created',
            'data' => $investment,
        ], 201);
    }
}
