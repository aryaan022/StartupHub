@extends('layouts.main')

@section('title', 'My Watchlist - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">My Watchlist</h1>
                <p class="text-slate-600 mt-1">{{ 28 }} startups saved</p>
            </div>
            <div class="flex gap-4">
                <select class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option>Sort by: Recently Added</option>
                    <option>Funding Raised</option>
                    <option>Team Size</option>
                </select>
            </div>
        </div>

        <!-- View Options -->
        <div class="flex gap-2 mb-8">
            <button class="px-4 py-2 bg-primary-100 text-primary-700 rounded-lg font-medium">Grid</button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200">List</button>
        </div>

        <!-- Startups Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @for ($i = 0; $i < 9; $i++)
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:border-primary-300 hover:shadow-premium-lg transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-{{ ['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'][array_rand(['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'])] }}-500 to-{{ ['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'][array_rand(['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'])] }}-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            {{ chr(65 + $i) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ ['TechFlow', 'CloudScale', 'Astra AI', 'InnovateLabs', 'Future Dynamics', 'Quantum Labs', 'DataStream', 'VentureTech', 'AI Innovations'][$i] }}</h3>
                            <p class="text-slate-600 text-sm">{{ ['AI workflow automation', 'Cloud infrastructure', 'AI research platform', 'Innovation consulting', 'Future tech development', 'Quantum computing', 'Data analytics', 'Venture tools', 'AI solutions'][$i] }}</p>
                        </div>
                    </div>
                    <button class="p-2 hover:bg-red-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ ['Series A', 'Seed', 'Series B', 'Series A', 'Seed', 'Pre-seed', 'Series B', 'Seed', 'Series A'][$i] }}</span>
                    <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ ['SaaS', 'Infrastructure', 'AI', 'Consulting', 'DeepTech', 'Hardware', 'Analytics', 'B2B', 'Enterprise'][$i] }}</span>
                </div>

                <div class="flex gap-4 py-4 border-y border-slate-200 mb-4 text-sm">
                    <div>
                        <p class="text-slate-600">Funding</p>
                        <p class="font-semibold text-slate-900">${{ ['2.5M', '5.2M', '1.8M', '3.4M', '800k', '2.1M', '4.2M', '1.5M', '3.8M'][$i] }}</p>
                    </div>
                    <div>
                        <p class="text-slate-600">Team</p>
                        <p class="font-semibold text-slate-900">{{ [32, 18, 45, 24, 12, 28, 35, 16, 42][$i] }}</p>
                    </div>
                </div>

                <a href="#" class="block text-primary-600 hover:text-primary-700 font-semibold">
                    View Profile →
                </a>
            </div>
            @endfor
        </div>

        <!-- Empty State Example -->
        <div class="text-center py-20">
            <p class="text-slate-600 mb-4">Add startups to your watchlist to track them later</p>
            <a href="{{ route('discover') }}" class="inline-block px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                Browse Startups
            </a>
        </div>
    </div>
</div>
@endsection
