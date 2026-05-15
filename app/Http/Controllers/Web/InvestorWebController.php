<?php

namespace App\Http\Controllers\Web;

use App\Models\Investor;
use App\Models\Startup;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvestorWebController extends Controller
{
    public function index(Request $request)
    {
        $investors = Investor::with('user')
            ->withCount('investments')
            ->latest()
            ->paginate(12);

        return view('investors.index', compact('investors'));
    }

    public function watchlist()
    {
        $investor = Investor::firstOrCreate(
            ['user_id' => Auth::id()],
            ['id' => Str::uuid()]
        );

        $watchlist = Watchlist::where('investor_id', $investor->id)
            ->with('startup')
            ->latest('added_at')
            ->paginate(12);

        return view('watchlist.index', compact('watchlist', 'investor'));
    }

    public function addToWatchlist(string $startupId)
    {
        $investor = Investor::firstOrCreate(
            ['user_id' => Auth::id()],
            ['id' => Str::uuid()]
        );

        Watchlist::firstOrCreate(
            ['investor_id' => $investor->id, 'startup_id' => $startupId],
            ['id' => Str::uuid(), 'added_at' => now()]
        );

        return back()->with('success', 'Added to watchlist.');
    }

    public function removeFromWatchlist(string $startupId)
    {
        $investor = Investor::where('user_id', Auth::id())->firstOrFail();

        Watchlist::where('investor_id', $investor->id)
            ->where('startup_id', $startupId)
            ->delete();

        return back()->with('success', 'Removed from watchlist.');
    }
}
