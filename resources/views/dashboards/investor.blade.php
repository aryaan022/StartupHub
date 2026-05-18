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

        <!-- INVESTMENT OPPORTUNITIES SECTION -->
        <div class="mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Browse Startups -->
                <a href="{{ route('discover') }}" class="bg-white border border-slate-200 rounded-lg p-6 hover:border-slate-300 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900">Discover Startups</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">Browse verified startups and investment opportunities</p>
                    <span class="text-sm font-medium text-blue-600 hover:text-blue-700">Explore →</span>
                </a>

                <!-- Funding Rounds -->
                <a href="{{ route('funding.index') }}" class="bg-white border border-slate-200 rounded-lg p-6 hover:border-slate-300 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900">Funding Rounds</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">View active funding opportunities and details</p>
                    <span class="text-sm font-medium text-green-600 hover:text-green-700">View →</span>
                </a>

                <!-- Watchlist -->
                <a href="{{ route('watchlist.index') }}" class="bg-white border border-slate-200 rounded-lg p-6 hover:border-slate-300 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900">Your Watchlist</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">{{ $watchlistCount }} startups saved for review</p>
                    <span class="text-sm font-medium text-slate-600 hover:text-slate-700">View →</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Getting Started -->
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-8">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-900 mb-3">Getting Started</h2>
                        <p class="text-slate-600 mb-6">Follow these steps to start investing on StartupHub:</p>
                        <ol class="space-y-3 mb-6 text-sm text-slate-700">
                            <li class="flex gap-3">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-semibold flex-shrink-0">1</span>
                                <span>Browse through verified startup profiles</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-semibold flex-shrink-0">2</span>
                                <span>Save interesting opportunities to your watchlist</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-semibold flex-shrink-0">3</span>
                                <span>Review due diligence and startup details</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-semibold flex-shrink-0">4</span>
                                <span>Make your investment decision</span>
                            </li>
                        </ol>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('discover') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors text-center text-sm">
                                Start Browsing
                            </a>
                            <a href="{{ route('resources.index') }}" class="px-6 py-2 bg-slate-200 text-slate-900 rounded-lg font-medium hover:bg-slate-300 transition-colors text-center text-sm">
                                Investment Guide
                            </a>
                        </div>
                    </div>
                </div>

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
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-4 text-base">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('discover') }}" class="block w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors text-center text-sm">
                            Browse Startups
                        </a>
                        <a href="{{ route('funding.index') }}" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-medium hover:bg-slate-200 transition-colors text-center text-sm">
                            View Funding Rounds
                        </a>
                        <a href="{{ route('watchlist.index') }}" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-medium hover:bg-slate-200 transition-colors text-center text-sm">
                            Manage Watchlist
                        </a>
                        <a href="{{ route('investors.index') }}" class="block w-full px-4 py-3 bg-slate-100 text-slate-900 rounded-lg font-medium hover:bg-slate-200 transition-colors text-center text-sm">
                            Network
                        </a>
                    </div>
                </div>

                <!-- Portfolio Overview -->
                <div class="bg-white rounded-lg border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-4 text-base">Portfolio Overview</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Active Investments</span>
                            <span class="font-semibold text-slate-900">{{ $investmentCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Total Invested</span>
                            <span class="font-semibold text-slate-900">${{ number_format($totalInvested / 1000000, 1) }}M</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Watchlist Items</span>
                            <span class="font-semibold text-slate-900">{{ $watchlistCount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Resources -->
                <div class="bg-blue-50 rounded-lg border border-blue-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-3 text-base">Learn & Grow</h3>
                    <p class="text-sm text-slate-700 mb-4">Access guides, templates, and best practices for making smarter investments.</p>
                    <a href="{{ route('resources.index') }}" class="inline-block text-sm font-medium text-blue-600 hover:text-blue-700">
                        Explore Resources →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
