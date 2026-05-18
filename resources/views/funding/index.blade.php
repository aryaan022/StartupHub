@extends('layouts.main')

@section('title', 'Funding Opportunities - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-4xl font-bold mb-4">Funding Opportunities</h1>
            <p class="text-xl text-primary-100">Connect with investors and secure funding for your startup</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Tabs -->
        <div x-data="{ tab: 'active' }" class="mb-12">
            <div class="flex gap-6 border-b border-slate-200 mb-8">
                <button 
                    @click="tab = 'active'" 
                    :class="tab === 'active' ? 'text-primary-600 border-b-2 border-primary-600' : 'text-slate-600'"
                    class="pb-4 font-semibold transition-colors"
                >
                    Open Funding Rounds
                </button>
                <button 
                    @click="tab = 'investors'" 
                    :class="tab === 'investors' ? 'text-primary-600 border-b-2 border-primary-600' : 'text-slate-600'"
                    class="pb-4 font-semibold transition-colors"
                >
                    Investors
                </button>
                <button 
                    @click="tab = 'guides'" 
                    :class="tab === 'guides' ? 'text-primary-600 border-b-2 border-primary-600' : 'text-slate-600'"
                    class="pb-4 font-semibold transition-colors"
                >
                    Guides & Resources
                </button>
            </div>

            <!-- Active Funding Rounds -->
            <div x-show="tab === 'active'" class="space-y-6">
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-700 mb-2">Featured Startups Seeking Funding</h3>
                        <p class="text-slate-600 mb-6">Browse our partner startups that are actively raising capital</p>
                        <a href="{{ route('discover') }}" class="inline-block px-6 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700">
                            Browse Startups
                        </a>
                    </div>
                </div>
            </div>

            <!-- Investors -->
            <div x-show="tab === 'investors'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($investors) && $investors->count() > 0)
                    @foreach($investors->take(9) as $investor)
                    <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full mx-auto flex items-center justify-center text-white text-2xl font-bold mb-4">
                                {{ strtoupper(substr($investor->user->name, 0, 1)) }}
                            </div>
                            <h3 class="font-bold text-slate-900 text-lg">{{ $investor->user->name }}</h3>
                            <p class="text-sm text-slate-600 mt-2">{{ $investor->investments_count }} investments</p>
                        </div>

                        <div class="space-y-3 border-y border-slate-200 py-4 mb-4">
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Active Investor</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $investor->user->email }}</span>
                            </div>
                        </div>

                        <a href="mailto:{{ $investor->user->email }}" class="block w-full px-4 py-2 bg-primary-50 text-primary-700 rounded-lg font-medium text-center hover:bg-primary-100 transition-colors">
                            Contact
                        </a>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <p class="text-slate-600 mb-4">No investors registered yet</p>
                        <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700">
                            Register as Investor
                        </a>
                    </div>
                @endif
            </div>

            <!-- Guides & Resources -->
            <div x-show="tab === 'guides'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg transition-all group">
                    <div class="flex items-start justify-between mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-semibold">Guide</span>
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">How to Prepare Your Pitch Deck</h3>
                    <p class="text-slate-600">Learn what investors look for and how to create a compelling pitch deck</p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg transition-all group">
                    <div class="flex items-start justify-between mb-4">
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-semibold">Guide</span>
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Series A Funding: Complete Checklist</h3>
                    <p class="text-slate-600">Everything you need to know before raising Series A funding</p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg transition-all group">
                    <div class="flex items-start justify-between mb-4">
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full font-semibold">Template</span>
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">SAFE Agreement Template</h3>
                    <p class="text-slate-600">Download and customize a standard SAFE agreement for your seed round</p>
                </a>

                <a href="#" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8 hover:shadow-premium-lg transition-all group">
                    <div class="flex items-start justify-between mb-4">
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs rounded-full font-semibold">Webinar</span>
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">Negotiating Term Sheets</h3>
                    <p class="text-slate-600">Live webinar: Understand key terms and how to negotiate them</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
