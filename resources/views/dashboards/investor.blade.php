@extends('layouts.main')

@section('title', 'Investor Dashboard - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Investor Dashboard</h1>
                <p class="text-lg text-slate-600">Manage your portfolio and discover opportunities</p>
            </div>
            <a href="{{ route('discover') }}" class="px-6 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                Discover Startups
            </a>
        </div>

        <!-- Portfolio Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Investments -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Active Investments</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $investmentCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Portfolio Value -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Total Invested</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">${{ number_format($totalInvested / 1000000, 1) }}M</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Watchlist -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Watchlist</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">{{ $watchlistCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Return -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Investments Count</p>
                        <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $investmentCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Portfolio -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Your Portfolio</h2>
                    <div class="space-y-4">
                        @forelse($watchlist as $item)
                            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg hover:border-slate-300 hover:bg-slate-50 transition-all group">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center text-white font-bold">
                                        {{ substr($item->startup->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $item->startup->name }}</h3>
                                        <p class="text-sm text-slate-600">{{ $item->startup->industry ?? 'Tech' }} • Watchlisted</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-slate-900">Pending Review</p>
                                    <p class="text-xs text-slate-600">Added {{ $item->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-600">
                                <p>No watchlist items yet. <a href="{{ route('discover') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Start exploring startups</a></p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Deal Opportunities -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Recommended Deals</h2>
                        <a href="{{ route('discover') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                            View All →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recommended as $startup)
                            <div class="p-4 border border-slate-200 rounded-lg hover:border-primary-300 hover:shadow-premium transition-all group cursor-pointer">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $startup->name }}</h3>
                                        <p class="text-xs text-slate-600">{{ $startup->industry ?? 'Tech' }} • {{ $startup->stage ?? 'Seed' }}</p>
                                    </div>
                                    <button class="p-2 hover:bg-primary-100 rounded-lg">
                                        <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-sm text-slate-600 mb-3">{{ substr($startup->description, 0, 80) }}...</p>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-primary-600 font-semibold">Open for funding</span>
                                    <a href="{{ route('startups.show', $startup->id) }}" class="px-3 py-1 bg-primary-50 text-primary-700 rounded font-medium hover:bg-primary-100">
                                        View
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-600">
                                <p>No recommended deals at the moment</p>
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
                        <a href="{{ route('discover') }}" class="block w-full px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-semibold hover:bg-primary-100 transition-colors text-center">
                            Explore Startups
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            View Watchlist
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            Analytics
                        </a>
                        <a href="#" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-semibold hover:bg-slate-200 transition-colors text-center">
                            Update Profile
                        </a>
                    </div>
                </div>

                <!-- Investment Preferences -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl shadow-premium p-8 text-white">
                    <h3 class="font-bold mb-4 text-lg">Your Preferences</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Industries: AI, FinTech, SaaS</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Stages: Seed, Series A, Series B</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Ticket size: $250k - $2M</span>
                        </li>
                    </ul>
                    <a href="#" class="mt-6 inline-block text-sm font-semibold underline hover:opacity-90">
                        Edit Preferences →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
