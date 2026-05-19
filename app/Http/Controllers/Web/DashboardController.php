<?php

namespace App\Http\Controllers\Web;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Startup;
use App\Models\User;
use App\Models\Investor;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'founder'  => $this->founderDashboard($user),
            'investor' => $this->investorDashboard($user),
            'admin'    => $this->adminDashboard($user),
            default    => $this->seekerDashboard($user),
        };
    }

    private function founderDashboard($user)
    {
        $startups = Startup::where('founder_id', $user->id)->withCount(['jobs', 'applications'])->get();

        $startup = $startups->first();

        $recentApplications = $startup
            ? JobApplication::whereIn('job_id', $startup->jobs()->pluck('id'))
                ->with(['applicant', 'job'])
                ->latest()
                ->take(5)
                ->get()
            : collect();

        $stats = [
            'startups'     => $startups->count(),
            'jobs'         => $startup ? $startup->jobs()->where('is_active', true)->count() : 0,
            'applications' => $startup ? $startup->applications()->count() : 0,
            'total_raised' => $startup ? $startup->total_raised : 0,
        ];

        return view('dashboards.founder', compact('user', 'startups', 'startup', 'recentApplications', 'stats'));
    }

    private function investorDashboard($user)
    {
        $investor = Investor::firstOrCreate(
            ['user_id' => $user->id],
            ['id' => \Illuminate\Support\Str::uuid()]
        );

        $watchlistCount  = Watchlist::where('investor_id', $investor->id)->count();
        $investmentCount = $investor->investments()->count();
        $totalInvested   = $investor->investments()->where('status', 'completed')->sum('amount');

        $watchlist = Watchlist::where('investor_id', $investor->id)
            ->with('startup')
            ->latest('added_at')
            ->take(5)
            ->get();

        $recommended = Startup::where('visibility', 'public')
            ->whereNotIn('id', Watchlist::where('investor_id', $investor->id)->pluck('startup_id'))
            ->latest()
            ->take(6)
            ->get();

        return view('dashboards.investor', compact(
            'user', 'investor', 'watchlistCount', 'investmentCount',
            'totalInvested', 'watchlist', 'recommended'
        ));
    }

    private function seekerDashboard($user)
    {
        $applications = JobApplication::where('applicant_id', $user->id)
            ->with(['job.startup'])
            ->latest()
            ->paginate(10);

        $stats = [
            'total'       => JobApplication::where('applicant_id', $user->id)->count(),
            'shortlisted' => JobApplication::where('applicant_id', $user->id)->where('status', 'shortlisted')->count(),
            'accepted'    => JobApplication::where('applicant_id', $user->id)->where('status', 'accepted')->count(),
            'rejected'    => JobApplication::where('applicant_id', $user->id)->where('status', 'rejected')->count(),
        ];

        $recommended = Job::with('startup')
            ->where('is_active', true)
            ->whereNotIn('id', JobApplication::where('applicant_id', $user->id)->pluck('job_id'))
            ->latest()
            ->take(5)
            ->get();

        return view('dashboards.seeker', compact('user', 'applications', 'stats', 'recommended'));
    }

    private function adminDashboard($user)
    {
        $stats = [
            'users'    => User::count(),
            'startups' => Startup::count(),
            'jobs'     => Job::count(),
            'applications' => JobApplication::count(),
        ];

        $recentUsers    = User::latest()->take(10)->get();
        $recentStartups = Startup::with('founder')->latest()->take(10)->get();

        return view('admin.dashboard', compact('user', 'stats', 'recentUsers', 'recentStartups'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'nullable|string|max:20',
            'bio'        => 'nullable|string|max:1000',
            'avatar'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password updated successfully!');
    }

    public function deleteAccount()
    {
        $user = Auth::user();
        
        // Delete all related data
        if ($user->role === 'founder') {
            Startup::where('founder_id', $user->id)->delete();
        } elseif ($user->role === 'investor') {
            Investor::where('user_id', $user->id)->delete();
        }
        
        JobApplication::where('applicant_id', $user->id)->delete();
        
        // Delete the user
        $user->delete();
        
        Auth::logout();
        
        return redirect('/')->with('success', 'Account deleted successfully.');
    }

    public function admin()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return $this->adminDashboard(Auth::user());
    }
}
