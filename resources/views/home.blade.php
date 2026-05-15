@extends('layouts.main')

@section('title', 'StartupHub - Premium Startup Ecosystem Platform')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-20 pb-32 md:pt-32 md:pb-48">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-slate-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 0.5s"></div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
            <!-- Left Column -->
            <div class="animate-slideUp">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 3.062v6.718a3.066 3.066 0 01-3.062 3.062H7.117a3.066 3.066 0 01-3.062-3.062V6.517a3.066 3.066 0 012.812-3.062zm2.205-1.161a5.118 5.118 0 00-4.507 2.21.75.75 0 00.584 1.207 3.618 3.618 0 013.04-1.594.75.75 0 00.583-1.207 5.118 5.118 0 00-3.7-1.616z" clip-rule="evenodd"/>
                    </svg>
                    <span>✨ Join 5,000+ startups on the platform</span>
                </div>

                <!-- Headline -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-slate-900 leading-tight mb-6">
                    Where startups 
                    <span class="bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent">
                        meet opportunity
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-lg md:text-xl text-slate-600 mb-8 leading-relaxed">
                    The premium ecosystem connecting ambitious founders, sophisticated investors, and exceptional talent. Build, fund, and grow together.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-primary text-white rounded-xl font-semibold hover-glow">
                        <span>Launch Your Journey</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="{{ route('discover') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 border-2 border-slate-300 text-slate-900 rounded-xl font-semibold hover:border-slate-400 hover:bg-slate-50 transition-all">
                        <span>Explore Platform</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

                <!-- Social Proof -->
                <div class="mt-12 flex items-center gap-8">
                    <div>
                        <div class="text-3xl font-bold text-slate-900">5K+</div>
                        <p class="text-slate-600 text-sm">Active Startups</p>
                    </div>
                    <div class="w-px h-12 bg-slate-200"></div>
                    <div>
                        <div class="text-3xl font-bold text-slate-900">$2B+</div>
                        <p class="text-slate-600 text-sm">Funded</p>
                    </div>
                    <div class="w-px h-12 bg-slate-200"></div>
                    <div>
                        <div class="text-3xl font-bold text-slate-900">10K+</div>
                        <p class="text-slate-600 text-sm">Jobs Posted</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Hero Image -->
            <div class="hidden lg:block animate-fadeIn" style="animation-delay: 0.2s">
                <div class="relative">
                    <!-- Gradient Border -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/20 to-transparent rounded-2xl blur-2xl"></div>
                    
                    <!-- Card -->
                    <div class="relative bg-white rounded-2xl shadow-premium-lg p-8 border border-slate-100">
                        <!-- Dashboard Preview -->
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg"></div>
                                <div class="flex-1">
                                    <div class="h-2 bg-slate-200 rounded w-3/4 mb-2"></div>
                                    <div class="h-2 bg-slate-100 rounded w-1/2"></div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-slate-200">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-slate-900">$5.2M</div>
                                        <div class="text-xs text-slate-600">Raised</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-slate-900">42</div>
                                        <div class="text-xs text-slate-600">Team</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-slate-900">8K</div>
                                        <div class="text-xs text-slate-600">Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 md:py-32 bg-gradient-to-b from-slate-50 to-white" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">
                Everything you need to succeed
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                From ideation to exit, StartupHub provides the tools, connections, and resources to accelerate your journey.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group p-8 bg-white rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-premium transition-all hover-lift">
                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Lightning Fast</h3>
                <p class="text-slate-600">
                    Connect with investors and talent in real-time. No gatekeeping, just pure opportunity.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="group p-8 bg-white rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-premium transition-all hover-lift">
                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Bank-Grade Security</h3>
                <p class="text-slate-600">
                    Enterprise security protects your data, your company, and your future.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="group p-8 bg-white rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-premium transition-all hover-lift">
                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Powerful Controls</h3>
                <p class="text-slate-600">
                    Advanced filtering, analytics, and insights to make informed decisions.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="group p-8 bg-white rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-premium transition-all hover-lift">
                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Smart Matching</h3>
                <p class="text-slate-600">
                    AI-powered algorithms connect you with the right partners and opportunities.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="group p-8 bg-white rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-premium transition-all hover-lift">
                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Global Network</h3>
                <p class="text-slate-600">
                    Access investors and talent from around the world, 24/7.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="group p-8 bg-white rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-premium transition-all hover-lift">
                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Expert Support</h3>
                <p class="text-slate-600">
                    Dedicated team ready to help you succeed every step of the way.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- User Roles Section -->
<section class="py-20 md:py-32" data-animate>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">
                Built for your role
            </h2>
            <p class="text-xl text-slate-600">
                Whether you're founding, investing, or building your career
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Startups -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 p-8 border border-blue-200 hover:border-blue-400 transition-all hover-lift">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-24 h-24 bg-blue-200 rounded-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">For Founders</h3>
                    <ul class="space-y-2 text-slate-700 mb-6">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Raise capital efficiently</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Build your dream team</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Access resources & network</span>
                        </li>
                    </ul>
                    <a href="{{ route('register', ['role' => 'founder']) }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold group-hover:bg-blue-700 transition-colors">
                        Start Now
                    </a>
                </div>
            </div>

            <!-- Investors -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50 p-8 border border-emerald-200 hover:border-emerald-400 transition-all hover-lift">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-24 h-24 bg-emerald-200 rounded-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-emerald-500/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">For Investors</h3>
                    <ul class="space-y-2 text-slate-700 mb-6">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Deal flow at your fingertips</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Smart portfolio management</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Advanced analytics</span>
                        </li>
                    </ul>
                    <a href="{{ route('register', ['role' => 'investor']) }}" class="inline-block px-6 py-2 bg-emerald-600 text-white rounded-lg font-semibold group-hover:bg-emerald-700 transition-colors">
                        Join Now
                    </a>
                </div>
            </div>

            <!-- Job Seekers -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 p-8 border border-purple-200 hover:border-purple-400 transition-all hover-lift">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-24 h-24 bg-purple-200 rounded-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">For Job Seekers</h3>
                    <ul class="space-y-2 text-slate-700 mb-6">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-purple-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Curated startup opportunities</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-purple-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Build your professional brand</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-purple-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Connect with founders</span>
                        </li>
                    </ul>
                    <a href="{{ route('register', ['role' => 'job_seeker']) }}" class="inline-block px-6 py-2 bg-purple-600 text-white rounded-lg font-semibold group-hover:bg-purple-700 transition-colors">
                        Find Jobs
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 md:py-32 bg-gradient-primary text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            Ready to transform your startup journey?
        </h2>
        <p class="text-xl text-primary-100 mb-8">
            Join thousands of founders, investors, and talented professionals building the future.
        </p>
        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-600 rounded-xl font-semibold hover:shadow-premium-lg transition-all hover-glow">
            <span>Get Started Free Today</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>
</section>
@endsection
