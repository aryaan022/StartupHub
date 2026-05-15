@extends('layouts.main')

@section('title', 'Startup Profile - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
                <div class="flex items-start gap-6 flex-1">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center text-white text-4xl font-bold backdrop-blur-sm">
                        T
                    </div>
                    <div class="text-white">
                        <h1 class="text-4xl font-bold mb-2">TechFlow</h1>
                        <p class="text-blue-100 text-lg">AI-powered workflow automation platform</p>
                        <div class="flex gap-4 mt-4">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-sm backdrop-blur-sm">Series A</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-sm backdrop-blur-sm">San Francisco</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-sm backdrop-blur-sm">Founded 2021</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                        Add to Watchlist
                    </button>
                    <button class="px-6 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 transition-colors">
                        Follow
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-12">
                <!-- About -->
                <section>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">About</h2>
                    <p class="text-slate-700 leading-relaxed text-lg">
                        TechFlow is transforming how teams automate their workflows. Our AI-powered platform reduces manual work by 80%, helping companies scale faster. Used by 500+ companies including Fortune 500 enterprises.
                    </p>
                </section>

                <!-- Key Metrics -->
                <section>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Key Metrics</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl border border-slate-200 p-6">
                            <p class="text-slate-600 text-sm">Total Raised</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">$12.5M</p>
                        </div>
                        <div class="bg-white rounded-xl border border-slate-200 p-6">
                            <p class="text-slate-600 text-sm">Team Size</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">42</p>
                        </div>
                        <div class="bg-white rounded-xl border border-slate-200 p-6">
                            <p class="text-slate-600 text-sm">Active Customers</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">500+</p>
                        </div>
                        <div class="bg-white rounded-xl border border-slate-200 p-6">
                            <p class="text-slate-600 text-sm">Annual Growth</p>
                            <p class="text-3xl font-bold text-emerald-600 mt-2">+245%</p>
                        </div>
                    </div>
                </section>

                <!-- Team -->
                <section>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Leadership Team</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-premium transition-all">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=founder1" alt="Founder" class="w-12 h-12 rounded-full">
                                <div>
                                    <h3 class="font-semibold text-slate-900">Sarah Chen</h3>
                                    <p class="text-sm text-slate-600">CEO & Co-founder</p>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm">Former AI researcher at OpenAI. Stanford PhD in ML.</p>
                        </div>

                        <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-premium transition-all">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=founder2" alt="Founder" class="w-12 h-12 rounded-full">
                                <div>
                                    <h3 class="font-semibold text-slate-900">Michael Rodriguez</h3>
                                    <p class="text-sm text-slate-600">CTO & Co-founder</p>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm">Ex-Google Engineer. Built systems at scale for 100M+ users.</p>
                        </div>
                    </div>
                </section>

                <!-- Open Positions -->
                <section>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Open Positions</h2>
                    <div class="space-y-4">
                        <a href="#" class="block p-4 border border-slate-200 rounded-lg hover:border-primary-300 hover:shadow-premium transition-all group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-slate-900 group-hover:text-primary-600 transition-colors">Senior Frontend Developer</h3>
                                    <p class="text-sm text-slate-600">Remote • Full-time • $150k - $200k</p>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                        <a href="#" class="block p-4 border border-slate-200 rounded-lg hover:border-primary-300 hover:shadow-premium transition-all group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-slate-900 group-hover:text-primary-600 transition-colors">Product Manager</h3>
                                    <p class="text-sm text-slate-600">San Francisco • Full-time • $140k - $180k</p>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Funding -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 sticky top-24">
                    <h3 class="font-bold text-slate-900 mb-6 text-lg">Funding</h3>
                    <div class="space-y-4">
                        <div class="pb-4 border-b border-slate-200">
                            <p class="text-xs text-slate-600 uppercase font-semibold mb-2">Series A</p>
                            <p class="font-bold text-slate-900">$8.5M</p>
                            <p class="text-sm text-slate-600">2023</p>
                        </div>
                        <div class="pb-4 border-b border-slate-200">
                            <p class="text-xs text-slate-600 uppercase font-semibold mb-2">Seed</p>
                            <p class="font-bold text-slate-900">$4M</p>
                            <p class="text-sm text-slate-600">2022</p>
                        </div>
                    </div>
                </div>

                <!-- Location & Links -->
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-900 mb-6 text-lg">Company</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold mb-1">Location</p>
                            <p class="text-slate-900">San Francisco, CA</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold mb-1">Website</p>
                            <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">www.techflow.ai</a>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold mb-3">Follow</p>
                            <div class="flex gap-3">
                                <a href="#" class="p-2 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                    <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20v-7.21H5.5V9.98h2.79V7.97c0-2.69 1.64-4.16 4.04-4.16 1.15 0 2.14.08 2.43.12v2.82h-1.67c-1.31 0-1.56.62-1.56 1.53v2h3.11l-.405 2.81h-2.705V20"/>
                                    </svg>
                                </a>
                                <a href="#" class="p-2 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                    <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7"/>
                                    </svg>
                                </a>
                                <a href="#" class="p-2 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                    <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                                        <circle cx="4" cy="4" r="2"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
