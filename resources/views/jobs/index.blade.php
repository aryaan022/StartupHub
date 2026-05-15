@extends('layouts.main')

@section('title', 'Jobs & Internships - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Find Your Next Opportunity</h1>
                    <p class="text-primary-100 text-lg">{{ $jobs->total() }} amazing jobs at startups</p>
                </div>
                @auth
                    @if(Auth::user()->role === 'founder')
                        <a href="{{ route('jobs.create') }}" class="px-6 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:shadow-lg transition-all">
                            Post a Job
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="GET" action="{{ route('jobs.index') }}" class="bg-white rounded-xl shadow-md border border-slate-200 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Search Jobs</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="e.g., Developer, Designer..."
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Job Type</label>
                    <select name="job_type" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">All Types</option>
                        <option value="full_time" @selected(request('job_type') === 'full_time')>Full-time</option>
                        <option value="part_time" @selected(request('job_type') === 'part_time')>Part-time</option>
                        <option value="contract" @selected(request('job_type') === 'contract')>Contract</option>
                        <option value="internship" @selected(request('job_type') === 'internship')>Internship</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Experience Level</label>
                    <select name="experience_level" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">All Levels</option>
                        <option value="entry" @selected(request('experience_level') === 'entry')>Entry Level</option>
                        <option value="junior" @selected(request('experience_level') === 'junior')>Junior</option>
                        <option value="mid" @selected(request('experience_level') === 'mid')>Mid Level</option>
                        <option value="senior" @selected(request('experience_level') === 'senior')>Senior</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Remote</label>
                    <select name="remote_type" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">All Types</option>
                        <option value="remote" @selected(request('remote_type') === 'remote')>Fully Remote</option>
                        <option value="hybrid" @selected(request('remote_type') === 'hybrid')>Hybrid</option>
                        <option value="onsite" @selected(request('remote_type') === 'onsite')>On-site</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 flex gap-3">
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all">
                    Search
                </button>
                <a href="{{ route('jobs.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition-all">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Job Listings -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if($jobs->count() > 0)
            <div class="grid gap-4">
                @foreach($jobs as $job)
                    <a href="{{ route('jobs.show', $job->id) }}" class="group">
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md hover:border-primary-300 transition-all p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <!-- Job Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start gap-4">
                                        <!-- Company Logo -->
                                        @if($job->startup->logo_url)
                                            <img 
                                                src="{{ $job->startup->logo_url }}" 
                                                alt="{{ $job->startup->name }}"
                                                class="w-12 h-12 rounded-lg object-cover flex-shrink-0"
                                            >
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                                                {{ substr($job->startup->name, 0, 1) }}
                                            </div>
                                        @endif

                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors truncate">
                                                {{ $job->title }}
                                            </h3>
                                            <p class="text-slate-600 font-semibold">{{ $job->startup->name }}</p>
                                            <p class="text-sm text-slate-500 mt-1">{{ $job->location ?? 'Remote' }}</p>
                                        </div>
                                    </div>

                                    <!-- Description preview -->
                                    <p class="text-slate-600 mt-3 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit($job->description, 150) }}
                                    </p>

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2 mt-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-700">
                                            @switch($job->job_type)
                                                @case('full_time')
                                                    Full-time
                                                @break
                                                @case('part_time')
                                                    Part-time
                                                @break
                                                @case('contract')
                                                    Contract
                                                @break
                                                @case('internship')
                                                    Internship
                                                @break
                                            @endswitch
                                        </span>

                                        @if($job->experience_level)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">
                                                {{ ucfirst($job->experience_level) }} Level
                                            </span>
                                        @endif

                                        @if($job->remote_type)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                                @switch($job->remote_type)
                                                    @case('remote')
                                                        Remote
                                                    @break
                                                    @case('hybrid')
                                                        Hybrid
                                                    @break
                                                    @case('onsite')
                                                        On-site
                                                    @break
                                                @endswitch
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Salary & Apply -->
                                <div class="md:text-right">
                                    @if($job->salary_min && $job->salary_max)
                                        <div class="text-lg font-bold text-slate-900 mb-4">
                                            ${{ number_format($job->salary_min / 1000) }}K - ${{ number_format($job->salary_max / 1000) }}K
                                        </div>
                                    @endif
                                    
                                    @auth
                                        @if(Auth::user()->role === 'job_seeker')
                                            <a href="{{ route('jobs.show', $job->id) }}" class="w-full md:w-auto block px-6 py-2 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all text-center">
                                                View & Apply
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="w-full md:w-auto block px-6 py-2 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all text-center">
                                            Sign in to Apply
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $jobs->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-lg text-slate-600">No jobs found. Try adjusting your filters.</p>
            </div>
        @endif
    </div>
</div>
@endsection
