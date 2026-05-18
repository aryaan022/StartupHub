@extends('layouts.main')

@section('title', $job->title . ' at ' . $job->startup->name . ' - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Link -->
        <a href="{{ route('jobs.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold flex items-center gap-2 mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Jobs
        </a>

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-bold text-slate-900">{{ $job->title }}</h1>
                <p class="text-lg text-slate-600 mt-2">{{ $job->startup->name }} • {{ $job->location ?? 'Remote' }} • {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</p>
                <div class="flex gap-4 mt-4">
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-sm rounded-full font-medium">Active</span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full font-medium">Posted {{ $job->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                <section class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">About the Role</h2>
                    <div class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                        {{ $job->description }}
                    </div>
                </section>

                <!-- Requirements -->
                @if($job->requirements)
                <section class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">Requirements</h2>
                    <div class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                        {{ $job->requirements }}
                    </div>
                </section>
                @endif

                <!-- Benefits -->
                @if($job->benefits)
                <section class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">Benefits & Perks</h2>
                    <div class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                        {{ $job->benefits }}
                    </div>
                </section>
                @endif

                <!-- Skills -->
                @if($job->skills_required && is_array($job->skills_required) && count($job->skills_required) > 0)
                <section class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">Required Skills</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($job->skills_required as $skill)
                            <span class="px-4 py-2 bg-primary-100 text-primary-700 rounded-full font-medium">{{ $skill }}</span>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- About Company -->
                <section class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">About {{ $job->startup->name }}</h2>
                    <p class="text-slate-700 leading-relaxed mb-4">{{ $job->startup->description }}</p>
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t border-slate-200">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase mb-1">Stage</p>
                            <p class="font-bold text-slate-900">{{ ucfirst(str_replace('_', ' ', $job->startup->stage)) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase mb-1">Industry</p>
                            <p class="font-bold text-slate-900">{{ $job->startup->industry }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase mb-1">Team Size</p>
                            <p class="font-bold text-slate-900">{{ $job->startup->team_size }} people</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Apply Card -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 sticky top-24">
                    @auth
                        @if(Auth::user()->role !== 'job_seeker')
                            <div class="text-center py-6">
                                <p class="text-slate-600 text-sm">Only job seekers can apply</p>
                            </div>
                        @elseif($hasApplied)
                            <div class="text-center py-6 bg-emerald-50 rounded-lg">
                                <p class="text-emerald-700 font-semibold text-sm">✓ Application Submitted</p>
                            </div>
                        @else
                            <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <textarea name="cover_letter" rows="3" placeholder="Cover letter..." class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" required></textarea>
                                <input type="file" name="resume" accept=".pdf,.doc,.docx" class="w-full text-sm" required>
                                <input type="url" name="portfolio_url" placeholder="Portfolio URL" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                                <button type="submit" class="w-full px-4 py-2 bg-primary-600 text-white rounded-lg font-semibold text-sm">Apply</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full px-4 py-2 bg-primary-600 text-white rounded-lg text-center text-sm mb-2">Sign In</a>
                        <a href="{{ route('register') }}" class="block w-full px-4 py-2 border border-primary-600 text-primary-600 rounded-lg text-center text-sm">Register</a>
                    @endauth
                </div>

                <!-- Job Details -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-900 mb-6 text-lg">Details</h3>
                    <div class="space-y-4 text-sm">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase mb-1">Experience</p>
                            <p class="text-slate-900">{{ ucfirst($job->experience_level ?? 'N/A') }}</p>
                        </div>
                        @if($job->salary_min && $job->salary_max)
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase mb-1">Salary</p>
                            <p class="text-slate-900">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs text-slate-600 font-semibold uppercase mb-1">Type</p>
                            <p class="text-slate-900">{{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Company Card -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl shadow-premium p-6 text-white">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center text-2xl font-bold mb-4">
                        {{ substr($job->startup->name, 0, 1) }}
                    </div>
                    <h3 class="font-bold text-lg mb-1">{{ $job->startup->name }}</h3>
                    <p class="text-primary-100 text-xs mb-4">{{ $job->startup->industry }}</p>
                    <div class="space-y-1 text-sm">
                        <p class="flex items-center gap-2"><span class="font-semibold">Team Size:</span> {{ $job->startup->team_size }} people</p>
                        <p class="flex items-center gap-2"><span class="font-semibold">Stage:</span> {{ ucfirst(str_replace('_', ' ', $job->startup->stage)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
