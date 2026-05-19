<?php

namespace App\Http\Controllers\Web;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Startup;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvestmentController extends Controller
{
    /**
     * Show investment form for a specific startup
     */
    public function create($startupId)
    {
        $startup = Startup::findOrFail($startupId);
        $investor = Investor::firstOrCreate(
            ['user_id' => auth()->id()],
            ['id' => \Illuminate\Support\Str::uuid()]
        );

        return view('investments.create', compact('startup', 'investor'));
    }

    /**
     * Store the investment
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'startup_id' => 'required|exists:startups,id',
            'amount' => 'required|numeric|min:1000|max:10000000',
            'investment_type' => 'required|in:seed,series_a,series_b,series_c,venture,angel,strategic',
            'equity_percentage' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string|max:500',
        ]);

        $investor = Investor::firstOrCreate(
            ['user_id' => auth()->id()],
            ['id' => \Illuminate\Support\Str::uuid()]
        );

        // Check if already invested
        $existing = Investment::where('startup_id', $validated['startup_id'])
            ->where('investor_id', $investor->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already invested in this startup. You can update your investment in your portfolio.');
        }

        // Create investment
        $investment = Investment::create([
            'startup_id' => $validated['startup_id'],
            'investor_id' => $investor->id,
            'amount' => $validated['amount'],
            'currency' => 'USD',
            'investment_type' => $validated['investment_type'],
            'equity_percentage' => $validated['equity_percentage'] ?? 0,
            'status' => 'completed',
            'invested_at' => now(),
            'notes' => $validated['notes'] ?? null,
        ]);

        // Add to watchlist if not already there
        Watchlist::firstOrCreate([
            'investor_id' => $investor->id,
            'startup_id' => $validated['startup_id'],
        ], [
            'id' => \Illuminate\Support\Str::uuid(),
            'added_at' => now(),
        ]);

        return redirect("/startups/{$validated['startup_id']}")
            ->with('success', 'Investment successful! You can now track this startup in your portfolio.');
    }

    /**
     * Show investor's investments
     */
    public function portfolio()
    {
        $investor = Investor::firstOrCreate(
            ['user_id' => auth()->id()],
            ['id' => \Illuminate\Support\Str::uuid()]
        );

        $investments = Investment::where('investor_id', $investor->id)
            ->with('startup')
            ->latest('invested_at')
            ->paginate(12);

        $totalInvested = Investment::where('investor_id', $investor->id)->sum('amount');
        $investmentCount = Investment::where('investor_id', $investor->id)->count();

        return view('investments.portfolio', compact('investments', 'totalInvested', 'investmentCount'));
    }

    /**
     * Delete/cancel an investment
     */
    public function cancel($id)
    {
        $investment = Investment::findOrFail($id);
        $investor = Investor::firstOrCreate(
            ['user_id' => auth()->id()],
            ['id' => \Illuminate\Support\Str::uuid()]
        );

        if ($investment->investor_id !== $investor->id) {
            return redirect('/dashboard')->with('error', 'Unauthorized.');
        }

        $investment->delete();

        return redirect()->back()->with('success', 'Investment removed from your portfolio.');
    }
}
