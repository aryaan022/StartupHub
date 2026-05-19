@extends('layouts.main')
@section('title', 'Discover Startups - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">

    {{-- Sticky filter bar --}}
    <div class="bg-white border-b border-slate-200 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <form method="GET" action="{{ route('discover') }}" class="flex flex-col md:flex-row gap-3 items-start md:items-center">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-slate-900">Discover Startups</h1>
                    <p class="text-slate-500 text-sm">{{ $startups->total() }} companies found</p>
                </div>
                <div class="flex flex-wrap gap-2 flex-1">
                    <input name="search" value="{{ request('search') }}" placeholder="Search startups…"
                        class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-48">

                    <select name="industry" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Industries</option>
                        @foreach($industries as $ind)
                            <option value="{{ $ind }}" @selected(request('industry') === $ind)>{{ $ind }}</option>
                        @endforeach
                    </select>

                    <select name="stage" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Stages</option>
                        @foreach($stages as $s)
                            <option value="{{ $s }}" @selected(request('stage') === $s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>

                    <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="hiring" value="1" @checked(request('hiring')) class="w-4 h-4 text-blue-600 rounded">
                        Hiring
                    </label>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                        Filter
                    </button>
                    @if(request()->hasAny(['search','industry','stage','hiring']))
                        <a href="{{ route('discover') }}" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm hover:bg-slate-50">Clear</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if($startups->isEmpty())
            <div class="text-center py-24">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-slate-700 mb-2">No startups found</h3>
                <p class="text-slate-500 mb-6">Try adjusting your filters or be the first to list yours.</p>
                @auth
                    <a href="{{ route('startups.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                        List Your Startup
                    </a>
                @endauth
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($startups as $startup)
                <div class="bg-white rounded-xl border border-slate-200 p-6 hover:border-blue-300 hover:shadow-lg transition-all group overflow-hidden flex flex-col h-full">
                    <div class="flex items-start justify-between mb-4 gap-3">
                        <div class="flex items-start gap-3 flex-1 min-w-0">
                            @if($startup->logo_url)
                                <img src="{{ $startup->logo_url }}" alt="{{ $startup->name }}" class="w-14 h-14 rounded-lg object-cover border border-slate-100 flex-shrink-0">
                            @else
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                                    {{ strtoupper(substr($startup->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate">
                                    {{ $startup->name }}
                                </h2>
                                <p class="text-slate-500 text-sm line-clamp-2">{{ $startup->short_description ?? $startup->industry }}</p>
                                <div class="flex gap-2 mt-2 flex-wrap">
                                    @if($startup->stage)
                                        <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-xs rounded font-medium whitespace-nowrap">{{ ucfirst(str_replace('_',' ',$startup->stage)) }}</span>
                                    @endif
                                    <span class="px-2 py-0.5 bg-blue-50 text-blue-700 text-xs rounded font-medium whitespace-nowrap">{{ $startup->industry }}</span>
                                    @if($startup->is_hiring)
                                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-xs rounded font-medium whitespace-nowrap">Hiring</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @auth
                        <form method="POST" action="{{ route('watchlist.add', $startup->id) }}" class="flex-shrink-0">
                            @csrf
                            <button type="submit" title="Add to watchlist" class="p-2 hover:bg-blue-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5 text-slate-400 hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </form>
                        @endauth
                    </div>

                    <div class="flex gap-4 py-3 border-y border-slate-100 mb-4 text-sm">
                        @if($startup->total_raised > 0)
                        <div>
                            <p class="text-slate-500 text-xs">Raised</p>
                            <p class="font-semibold text-slate-900">${{ number_format($startup->total_raised / 1000000, 1) }}M</p>
                        </div>
                        @endif
                        @if($startup->team_size)
                        <div>
                            <p class="text-slate-500 text-xs">Team</p>
                            <p class="font-semibold text-slate-900">{{ $startup->team_size }}</p>
                        </div>
                        @endif
                        @if($startup->city)
                        <div>
                            <p class="text-slate-500 text-xs">Location</p>
                            <p class="font-semibold text-slate-900">{{ $startup->city }}</p>
                        </div>
                        @endif
                        @if($startup->jobs_count > 0)
                        <div>
                            <p class="text-slate-500 text-xs">Open Roles</p>
                            <p class="font-semibold text-emerald-600">{{ $startup->jobs_count }}</p>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('startups.show', $startup->id) }}" class="block text-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-semibold hover:bg-blue-100 transition-colors text-sm">
                        View Profile →
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $startups->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
