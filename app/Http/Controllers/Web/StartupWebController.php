<?php

namespace App\Http\Controllers\Web;

use App\Models\Startup;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StartupWebController extends Controller
{
    public function discover(Request $request)
    {
        $query = Startup::with('founder')
            ->where('visibility', '!=', 'private')
            ->withCount(['jobs' => fn($q) => $q->where('is_active', true)]);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%$s%")->orWhere('description', 'like', "%$s%"));
        }
        if ($request->filled('industry'))  $query->where('industry', $request->industry);
        if ($request->filled('stage'))     $query->where('stage', $request->stage);
        if ($request->filled('hiring'))    $query->where('is_hiring', true);

        $startups  = $query->latest()->paginate(12)->withQueryString();
        $industries = Startup::where('visibility', '!=', 'private')->distinct()->pluck('industry')->filter()->sort()->values();
        $stages     = ['idea','pre_seed','seed','series_a','series_b','series_c','growth'];

        return view('startups.discover', compact('startups', 'industries', 'stages'));
    }

    public function show(string $id)
    {
        $startup = Startup::with(['founder', 'teamMembers', 'profile', 'investments.investor.user'])
            ->withCount(['jobs' => fn($q) => $q->where('is_active', true)])
            ->findOrFail($id);

        $startup->increment('view_count');

        $jobs = $startup->jobs()->where('is_active', true)->latest()->get();

        $userApplication = null;
        if (Auth::check()) {
            $userApplication = \App\Models\JobApplication::where('startup_id', $id)
                ->where('applicant_id', Auth::id())
                ->first();
        }

        return view('startups.show', compact('startup', 'jobs', 'userApplication'));
    }

    public function create()
    {
        return view('startups.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'              => 'required|string|max:255|unique:startups',
            'industry'          => 'required|string|max:100',
            'short_description' => 'required|string|max:500',
            'description'       => 'required|string',
            'founded_at'        => 'nullable|date',
            'city'              => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'website_url'       => 'nullable|url',
            'stage'             => 'nullable|in:idea,pre_seed,seed,series_a,series_b,series_c,growth,exit',
        ];

        // Only validate logo if a file is actually provided
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $rules['logo'] = 'image|max:2048';
        }

        $data = $request->validate($rules);

        $logoUrl = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logoUrl = $request->file('logo')->store('logos', 'public');
        }

        $startup = Startup::create([
            'id'                => Str::uuid(),
            'founder_id'        => Auth::id(),
            'name'              => $data['name'],
            'slug'              => Str::slug($data['name']),
            'industry'          => $data['industry'],
            'short_description' => $data['short_description'],
            'description'       => $data['description'],
            'founded_at'        => $data['founded_at'] ?? null,
            'city'              => $data['city'] ?? null,
            'country'           => $data['country'] ?? null,
            'website_url'       => $data['website_url'] ?? null,
            'stage'             => $data['stage'] ?? null,
            'logo_url'          => $logoUrl ? Storage::url($logoUrl) : null,
            'visibility'        => 'public',
        ]);

        $startup->profile()->create(['id' => Str::uuid()]);

        return redirect()->route('startups.manage', $startup->id)
            ->with('success', 'Startup created successfully!');
    }

    public function manage(string $id)
    {
        $startup = Startup::with(['teamMembers', 'jobs', 'investments'])
            ->where('founder_id', Auth::id())
            ->findOrFail($id);

        $applications = \App\Models\JobApplication::whereIn('job_id', $startup->jobs->pluck('id'))
            ->with(['applicant', 'job'])
            ->latest()
            ->paginate(10);

        return view('startups.manage', compact('startup', 'applications'));
    }

    public function update(Request $request, string $id)
    {
        $startup = Startup::where('founder_id', Auth::id())->findOrFail($id);

        $data = $request->validate([
            'name'              => 'required|string|max:255|unique:startups,name,'.$startup->id,
            'industry'          => 'required|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'required|string',
            'website_url'       => 'nullable|url',
            'stage'             => 'nullable|in:idea,pre_seed,seed,series_a,series_b,series_c,growth,exit',
            'city'              => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'team_size'         => 'nullable|integer|min:1',
            'is_hiring'         => 'boolean',
            'logo'              => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo_url'] = Storage::url($path);
        }

        $startup->update(array_merge($data, ['slug' => Str::slug($data['name'])]));

        return back()->with('success', 'Startup updated successfully!');
    }
}
