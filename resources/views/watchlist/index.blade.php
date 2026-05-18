@extends('layouts.main')

@section('title', 'My Watchlist - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">My Watchlist</h1>
                <p class="text-slate-600 mt-1">{{ $watchlist->total() }} startups saved</p>
            </div>
            @if($watchlist->total() > 0)
            <div class="flex gap-4">
                <select class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option>Sort by: Recently Added</option>
                    <option>Funding Raised</option>
                    <option>Team Size</option>
                </select>
            </div>
            @endif
        </div>

        <!-- Startups Grid -->
        @if($watchlist->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($watchlist as $item)
            @php $startup = $item->startup; @endphp
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:border-primary-300 hover:shadow-premium-lg transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start gap-4 flex-1">
                        <!-- Logo -->
                        @if($startup->logo_url)
                            <img src="{{ $startup->logo_url }}" alt="{{ $startup->name }}" class="w-14 h-14 rounded-lg object-cover border border-slate-100">
                        @else
                            <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($startup->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ $startup->name }}</h3>
                            <p class="text-slate-600 text-sm">{{ $startup->short_description ?? $startup->industry }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('watchlist.remove', $startup->id) }}" onclick="return confirm('Remove from watchlist?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 hover:bg-red-100 rounded-lg transition-colors">
                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($startup->stage)
                    <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ ucfirst(str_replace('_', ' ', $startup->stage)) }}</span>
                    @endif
                    @if($startup->industry)
                    <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ $startup->industry }}</span>
                    @endif
                </div>

                <!-- Stats -->
                <div class="flex gap-4 py-4 border-y border-slate-200 mb-4 text-sm">
                    @if($startup->total_raised > 0)
                    <div>
                        <p class="text-slate-600">Funding</p>
                        <p class="font-semibold text-slate-900">${{ number_format($startup->total_raised / 1000000, 1) }}M</p>
                    </div>
                    @endif
                    @if($startup->team_size)
                    <div>
                        <p class="text-slate-600">Team</p>
                        <p class="font-semibold text-slate-900">{{ $startup->team_size }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-slate-600">Added</p>
                        <p class="font-semibold text-slate-900">{{ $item->added_at->diffForHumans() }}</p>
                    </div>
                </div>

                <a href="{{ route('startups.show', $startup->id) }}" class="block text-primary-600 hover:text-primary-700 font-semibold">
                    View Profile →
                </a>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mb-12">
            {{ $watchlist->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-slate-700 mb-2">Your watchlist is empty</h3>
            <p class="text-slate-600 mb-6">Add startups to your watchlist to track them later</p>
            <a href="{{ route('discover') }}" class="inline-block px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                Browse Startups
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
