@extends('layouts.main')

@section('title', 'Investor Profiles - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900">Featured Investors</h1>
            <p class="text-slate-600 mt-2">Connect with active investors in the startup ecosystem</p>
        </div>

        <!-- Filters -->
        <div class="flex gap-2 mb-8 flex-wrap">
            <button class="px-4 py-2 bg-primary-100 text-primary-700 rounded-full font-medium text-sm hover:bg-primary-200 transition-colors">
                All
            </button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-full font-medium text-sm hover:bg-slate-200 transition-colors">
                Venture Capital
            </button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-full font-medium text-sm hover:bg-slate-200 transition-colors">
                Angel Investors
            </button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-full font-medium text-sm hover:bg-slate-200 transition-colors">
                Corporate
            </button>
        </div>

        <!-- Investors Grid -->
        @if($investors->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($investors as $investor)
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden hover:shadow-premium-lg transition-all group">
                <!-- Header Gradient -->
                <div class="h-24 bg-gradient-to-r from-primary-500 to-primary-600"></div>

                <!-- Content -->
                <div class="px-6 -mt-12 pb-6 relative">
                    <!-- Avatar -->
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $investor->user->name }}" alt="{{ $investor->user->name }}" class="w-20 h-20 rounded-full border-4 border-white">

                    <!-- Info -->
                    <div class="mt-4">
                        <h3 class="text-xl font-bold text-slate-900">{{ $investor->user->name }}</h3>
                        <p class="text-sm text-slate-600">{{ $investor->investment_type ?? 'Investor' }}</p>
                    </div>

                    <!-- Bio -->
                    @if($investor->bio)
                    <p class="text-sm text-slate-600 mt-4 line-clamp-2">{{ $investor->bio }}</p>
                    @endif

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 mt-6 py-4 border-y border-slate-200">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Investments</p>
                            <p class="text-lg font-bold text-slate-900">{{ $investor->investments_count }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Email</p>
                            <p class="text-sm font-semibold text-primary-600">Contact</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Portfolio</p>
                            <p class="text-lg font-bold text-slate-900">Active</p>
                        </div>
                    </div>

                    <!-- Focus Areas -->
                    @if($investor->focus_sectors)
                    <div class="mt-4">
                        <p class="text-xs text-slate-600 font-semibold mb-2">Focus Areas</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $investor->focus_sectors) as $sector)
                            <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ trim($sector) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="mt-6 space-y-3">
                        <a href="mailto:{{ $investor->user->email }}" class="block w-full px-4 py-2 bg-gradient-primary text-white rounded-lg font-medium text-center hover-glow">
                            Contact Investor
                        </a>
                        @auth
                        @if(auth()->user()->role === 'founder')
                        <button onclick="alert('Message feature coming soon')" class="w-full px-4 py-2 border border-primary-300 text-primary-700 rounded-lg font-medium hover:bg-primary-50 transition-colors">
                            Send Message
                        </button>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $investors->links() }}
        </div>
        @else
        <div class="text-center py-12 bg-slate-100 rounded-lg">
            <p class="text-slate-600 text-lg">No investors found.</p>
        </div>
        @endif
    </div>
</div>
@endsection
