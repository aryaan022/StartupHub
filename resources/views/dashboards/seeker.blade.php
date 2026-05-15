@extends('layouts.main')

@section('title', 'Job Seeker Dashboard - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">My Career Dashboard</h1>
                <p class="text-lg text-slate-600">Track applications and discover opportunities</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="px-6 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                Browse Jobs
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Applications -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Total Applications</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Shortlisted -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Shortlisted</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['shortlisted'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Accepted -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Accepted</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['accepted'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Rejected -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Rejected</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['rejected'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Application Status -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Your Applications</h2>
                        <a href="{{ route('jobs.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                            Apply More →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($applications as $app)
                            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg hover:border-slate-300 transition-all group">
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                                        {{ substr($app->job->startup->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $app->job->title }}</h3>
                                        <p class="text-sm text-slate-600">{{ $app->job->startup->name }} • {{ $app->job->location }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">{{ ucfirst($app->status) }}</span>
                                    <a href="{{ route('jobs.show', $app->job->id) }}" class="text-slate-400 hover:text-slate-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-600">
                                <p>No applications yet. <a href="{{ route('jobs.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Start applying</a></p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recommended Jobs -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Recommended for You</h2>
                        <a href="{{ route('jobs.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                            View All →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recommended as $job)
                            <div class="p-4 border border-slate-200 rounded-lg hover:border-primary-300 hover:shadow-premium transition-all group cursor-pointer">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $job->title }}</h3>
                                        <p class="text-xs text-slate-600">{{ $job->startup->name }} • {{ $job->location }}</p>
                                    </div>
                                    <button class="p-2 hover:bg-primary-100 rounded-lg">
                                        <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-sm text-slate-600 mb-3">{{ substr($job->description, 0, 80) }}...</p>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-primary-600 font-semibold">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</span>
                                    <a href="{{ route('jobs.show', $job->id) }}" class="px-3 py-1 bg-primary-50 text-primary-700 rounded font-medium hover:bg-primary-100">
                                        Apply
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-600">
                                <p>No recommended jobs at the moment</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h3 class="font-bold text-slate-900 mb-6 text-lg">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('jobs.index') }}" class="block w-full px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-semibold hover:bg-primary-100 transition-colors text-center">
                            Browse Jobs
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            Update Resume
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            My Profile
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            Saved Jobs
                        </a>
                    </div>
                </div>

                <!-- Profile Completeness -->
                <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl shadow-premium p-8 text-white">
                    <h3 class="font-bold mb-4 text-lg">Profile Strength</h3>
                    <div class="mb-4">
                        <div class="h-3 bg-white/30 rounded-full overflow-hidden">
                            <div class="h-full w-3/4 bg-white"></div>
                        </div>
                        <p class="text-sm mt-2">75% Complete</p>
                    </div>
                    <ul class="space-y-2 text-sm mb-4">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Add projects</span>
                        </li>
                    </ul>
                    <a href="{{ route('profile.edit') }}" class="inline-block text-sm font-semibold underline hover:opacity-90">
                        Complete Profile →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
