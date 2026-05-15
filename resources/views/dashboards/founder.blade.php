@extends('layouts.main')

@section('title', 'Founder Dashboard - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Founder Dashboard</h1>
                <p class="text-lg text-slate-600">Manage your startup and track progress</p>
            </div>
            <a href="{{ route('startups.create') }}" class="px-6 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                Create Startup
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Startups -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Active Startups</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['startups'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Jobs Posted -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Jobs Posted</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['jobs'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.728 0-7.333-.957-10.464-2.637m21.464-13.11c-1.795.666-3.331 1.395-4.623 2.209.838-.314 1.68-.614 2.523-.914a23.857 23.857 0 001.5-2.294 23.847 23.847 0 01-3.4 6.4M5.464 3.118A23.89 23.89 0 0112 3c3.728 0 7.333.957 10.464 2.637"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Applications -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Applications</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['applications'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.656v5.656z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Funding -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Raised</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">${{ number_format($stats['total_raised'] / 1000000, 1) }}M</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- My Startups -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Your Startups</h2>
                        <a href="{{ route('startups.create') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                            Add New →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($startups as $s)
                            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg hover:border-slate-300 hover:bg-slate-50 transition-all group">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg group-hover:shadow-lg transition-all">
                                        {{ substr($s->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $s->name }}</h3>
                                        <p class="text-sm text-slate-600">{{ $s->industry }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="text-right hidden md:block">
                                        <p class="text-sm font-medium text-slate-900">Raised ${{ number_format($s->total_raised / 1000) }}K</p>
                                        <p class="text-xs text-slate-600">{{ ucfirst(str_replace('_', ' ', $s->stage)) }}</p>
                                    </div>
                                    <a href="{{ route('startups.show', $s->id) }}" class="text-primary-600 hover:text-primary-700 font-medium">
                                        Manage →
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-600">
                                <p>No startups yet. <a href="{{ route('startups.create') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Create one</a></p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Applications -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Recent Applications</h2>
                        @if($recentApplications->count() > 0)
                            <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">
                                View All →
                            </a>
                        @endif
                    </div>

                    <div class="space-y-4">
                        @forelse($recentApplications as $app)
                            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg hover:border-slate-300 transition-all">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($app->applicant->first_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $app->applicant->first_name }} {{ $app->applicant->last_name }}</h3>
                                        <p class="text-sm text-slate-600">Applied for {{ $app->job->title }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">{{ ucfirst($app->status) }}</span>
                                    <a href="#" class="text-primary-600 hover:text-primary-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-600">
                                <p>No applications yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h3 class="font-bold text-slate-900 mb-6 text-lg">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('startups.create') }}" class="block w-full px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-semibold hover:bg-primary-100 transition-colors text-center">
                            Create Startup
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            Post Job
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            Message Investors
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            View Analytics
                        </a>
                    </div>
                </div>

                <!-- Help & Resources -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl shadow-premium p-8 text-white">
                    <h3 class="font-bold mb-4 text-lg">Getting Started</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Complete your profile
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Add team members
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Post first job
                        </li>
                    </ul>
                    <a href="#" class="mt-6 inline-block text-sm font-semibold underline hover:opacity-90">
                        View Guides →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
