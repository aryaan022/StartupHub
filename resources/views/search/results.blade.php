@extends('layouts.main')

@section('title', 'Search Results - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Header -->
        <div class="mb-12">
            <div class="relative mb-8">
                <svg class="absolute left-4 top-3 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    value="AI startup" 
                    class="w-full pl-12 pr-4 py-4 border-2 border-slate-300 rounded-xl text-lg focus:outline-none focus:border-primary-500"
                    placeholder="Search startups, jobs, investors..."
                >
            </div>
            <p class="text-slate-600">Showing <span class="font-semibold">47</span> results for "<span class="font-semibold">AI startup</span>"</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Filters -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 space-y-6 sticky top-24">
                    <!-- Type Filter -->
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-4">Type</h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                <span class="text-sm text-slate-700">Startups</span>
                                <span class="ml-auto text-xs text-slate-500">23</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                <span class="text-sm text-slate-700">Jobs</span>
                                <span class="ml-auto text-xs text-slate-500">18</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                                <span class="text-sm text-slate-700">Investors</span>
                                <span class="ml-auto text-xs text-slate-500">6</span>
                            </label>
                        </div>
                    </div>

                    <!-- Industry -->
                    <div class="border-t border-slate-200 pt-6">
                        <h3 class="font-semibold text-slate-900 mb-4">Industry</h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                <span class="text-sm text-slate-700">AI/ML</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                                <span class="text-sm text-slate-700">SaaS</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                                <span class="text-sm text-slate-700">FinTech</span>
                            </label>
                        </div>
                    </div>

                    <!-- Funding Stage -->
                    <div class="border-t border-slate-200 pt-6">
                        <h3 class="font-semibold text-slate-900 mb-4">Funding Stage</h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                                <span class="text-sm text-slate-700">Seed</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                <span class="text-sm text-slate-700">Series A</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                <span class="text-sm text-slate-700">Series B+</span>
                            </label>
                        </div>
                    </div>

                    <button class="w-full py-2 border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors">
                        Clear Filters
                    </button>
                </div>
            </div>

            <!-- Results -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Startup Result -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:border-primary-300 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-primary rounded-lg flex items-center justify-center text-white font-bold">T</div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors">TechFlow</h3>
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded font-semibold">Startup</span>
                            </div>
                            <p class="text-slate-600 mb-2">AI-powered workflow automation platform. Reduces manual work by 80%, helping companies scale faster.</p>
                            <p class="text-sm text-slate-600 mb-3">San Francisco, CA • Series A • AI/ML</p>
                            <div class="flex gap-2">
                                <span class="text-xs text-slate-600">🔗</span>
                                <a href="#" class="text-primary-600 hover:underline text-sm">techflow.ai</a>
                            </div>
                        </div>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">View</a>
                    </div>
                </div>

                <!-- Job Result -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:border-primary-300 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors">AI/ML Engineer - Startup Role</h3>
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded font-semibold">Job</span>
                            </div>
                            <p class="text-slate-600 mb-2">Build machine learning systems for a fast-growing AI startup. Work with state-of-the-art models.</p>
                            <p class="text-sm text-slate-600">TechFlow • Remote • $130k - $160k • Full-time</p>
                        </div>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">Apply</a>
                    </div>
                </div>

                <!-- Investor Result -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:border-primary-300 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="flex items-start gap-4 mb-4">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=investor" alt="Investor" class="w-12 h-12 rounded-lg flex-shrink-0">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors">AI Ventures Fund</h3>
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded font-semibold">Investor</span>
                            </div>
                            <p class="text-slate-600 mb-2">Specialized fund focused on early-stage AI and machine learning companies. $200M AUM.</p>
                            <p class="text-sm text-slate-600">Seed to Series B • Global • Focus: AI/ML, Enterprise</p>
                        </div>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">View</a>
                    </div>
                </div>

                <!-- More Results -->
                @for ($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:border-primary-300 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-lg"></div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ ['CloudScale AI Platform', 'ML Engineer - Series B', 'Future Tech Ventures'][$i] }}</h3>
                            <p class="text-slate-600 text-sm mt-1">{{ ['Cloud infrastructure with AI capabilities...', 'Help build our ML infrastructure team...', 'Investing in emerging tech companies...'][$i] }}</p>
                        </div>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold flex-shrink-0">View</a>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Load More -->
        <div class="text-center mt-12">
            <button class="px-8 py-3 border-2 border-primary-300 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-colors">
                Load More Results
            </button>
        </div>
    </div>
</div>
@endsection
