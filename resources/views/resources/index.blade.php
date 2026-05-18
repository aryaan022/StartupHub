@extends('layouts.main')

@section('title', 'Resources - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-4xl font-bold mb-4">Resources & Learning Center</h1>
            <p class="text-xl text-primary-100">Guides, tools, and knowledge to help you succeed</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Guides & Articles -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-slate-900 mb-8">How-To Guides</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- For Founders -->
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg hover:border-primary-300 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Getting Started as a Founder</h3>
                    <p class="text-slate-600 mb-4">Learn how to list your startup, create a compelling profile, and attract investors</p>
                    <span class="text-primary-600 font-semibold">Read Guide →</span>
                </a>

                <!-- Fundraising 101 -->
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg hover:border-primary-300 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Fundraising 101</h3>
                    <p class="text-slate-600 mb-4">Complete guide to raising capital including pitch decks, term sheets, and valuation</p>
                    <span class="text-primary-600 font-semibold">Read Guide →</span>
                </a>

                <!-- For Investors -->
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg hover:border-primary-300 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Investor Guide</h3>
                    <p class="text-slate-600 mb-4">How to find deals, analyze startups, and build a profitable investment portfolio</p>
                    <span class="text-primary-600 font-semibold">Read Guide →</span>
                </a>

                <!-- Pitch Deck Template -->
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg hover:border-primary-300 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Pitch Deck Template</h3>
                    <p class="text-slate-600 mb-4">Download our professional pitch deck template used by successful founders</p>
                    <span class="text-primary-600 font-semibold">Download →</span>
                </a>

                <!-- Due Diligence Checklist -->
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg hover:border-primary-300 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-100 to-rose-200 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Due Diligence Checklist</h3>
                    <p class="text-slate-600 mb-4">Comprehensive checklist for evaluating investment opportunities</p>
                    <span class="text-primary-600 font-semibold">Download →</span>
                </a>

                <!-- Legal Templates -->
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg hover:border-primary-300 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Legal Templates</h3>
                    <p class="text-slate-600 mb-4">SAFE agreements, Term Sheets, and other legal documents templates</p>
                    <span class="text-primary-600 font-semibold">Download →</span>
                </a>
            </div>
        </div>

        <!-- Video Tutorials -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-slate-900 mb-8">Video Tutorials</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden hover:shadow-premium-lg transition-all group">
                    <div class="h-48 bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-slate-900 mb-2">How to Create Your Profile</h3>
                        <p class="text-sm text-slate-600 mb-4">5 min tutorial on setting up your StartupHub profile</p>
                        <button class="text-primary-600 font-semibold text-sm">Watch Now →</button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden hover:shadow-premium-lg transition-all group">
                    <div class="h-48 bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-slate-900 mb-2">Finding Investment Opportunities</h3>
                        <p class="text-sm text-slate-600 mb-4">Learn how to discover and evaluate potential investments</p>
                        <button class="text-primary-600 font-semibold text-sm">Watch Now →</button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden hover:shadow-premium-lg transition-all group">
                    <div class="h-48 bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-slate-900 mb-2">Pitching to Investors</h3>
                        <p class="text-sm text-slate-600 mb-4">Master the art of pitching your startup effectively</p>
                        <button class="text-primary-600 font-semibold text-sm">Watch Now →</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQs -->
        <div id="faqs" class="mb-16">
            <h2 class="text-3xl font-bold text-slate-900 mb-8">Frequently Asked Questions</h2>
            
            <div class="space-y-4">
                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden">
                    <button @click="open = !open" class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <span class="font-semibold text-slate-900">How do I start investing on StartupHub?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-slate-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </button>
                    <div x-show="open" class="px-8 py-6 border-t border-slate-200 bg-slate-50">
                        <p class="text-slate-700">First, register as an investor and complete your profile. Then visit the "Discover" page to browse startups, add them to your watchlist, and reach out to founders. You can also browse the "Investors" and "Funding" pages to learn about opportunities.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden">
                    <button @click="open = !open" class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <span class="font-semibold text-slate-900">What startups are available for investment?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-slate-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </button>
                    <div x-show="open" class="px-8 py-6 border-t border-slate-200 bg-slate-50">
                        <p class="text-slate-700">You can find investment opportunities on the <a href="{{ route('discover') }}" class="text-primary-600 font-semibold hover:underline">"Discover" page</a> (shows all public startups), <a href="{{ route('funding.index') }}" class="text-primary-600 font-semibold hover:underline">"Funding" page</a> (focused on fundraising), and <a href="{{ route('investors.index') }}" class="text-primary-600 font-semibold hover:underline">"Investors" page</a> (network with other investors).</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden">
                    <button @click="open = !open" class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <span class="font-semibold text-slate-900">How can I manage my watchlist?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-slate-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </button>
                    <div x-show="open" class="px-8 py-6 border-t border-slate-200 bg-slate-50">
                        <p class="text-slate-700">Visit your <a href="{{ route('watchlist.index') }}" class="text-primary-600 font-semibold hover:underline">watchlist page</a> to view all saved startups, add notes, and track their progress. You can add startups to your watchlist from any startup profile or the discover page.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden">
                    <button @click="open = !open" class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <span class="font-semibold text-slate-900">How do I contact a founder?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-slate-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </button>
                    <div x-show="open" class="px-8 py-6 border-t border-slate-200 bg-slate-50">
                        <p class="text-slate-700">You can contact founders directly through their startup profile or send them a message through your dashboard. Make sure your investor profile is complete so they can learn more about you.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden">
                    <button @click="open = !open" class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <span class="font-semibold text-slate-900">Is there a minimum investment amount?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-slate-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </button>
                    <div x-show="open" class="px-8 py-6 border-t border-slate-200 bg-slate-50">
                        <p class="text-slate-700">Minimum investment amounts vary by startup. Check each startup's funding page for specific requirements. StartupHub facilitates connections - actual investment terms are negotiated directly between you and the founder.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl p-12 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Start Investing?</h2>
            <p class="text-primary-100 mb-8 max-w-2xl mx-auto">Browse the best startups, connect with founders, and build your investment portfolio on StartupHub.</p>
            @auth
                @if(Auth::user()->role === 'investor')
                    <a href="{{ route('discover') }}" class="inline-block px-8 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:bg-slate-100 transition-colors">
                        Discover Startups
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:bg-slate-100 transition-colors">
                        Switch to Investor Account
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}?role=investor" class="inline-block px-8 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:bg-slate-100 transition-colors">
                    Register as Investor
                </a>
            @endauth
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
