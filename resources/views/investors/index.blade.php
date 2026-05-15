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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @for ($i = 0; $i < 9; $i++)
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden hover:shadow-premium-lg transition-all group">
                <!-- Header -->
                <div class="h-24 bg-gradient-to-r from-{{ ['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'][array_rand(['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'])] }}-500 to-{{ ['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'][array_rand(['blue', 'emerald', 'purple', 'amber', 'pink', 'cyan', 'indigo', 'rose', 'violet'])] }}-600"></div>

                <!-- Avatar -->
                <div class="px-6 -mt-12 pb-6 relative">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $i }}" alt="Investor" class="w-20 h-20 rounded-full border-4 border-white">

                    <!-- Info -->
                    <div class="mt-4">
                        <h3 class="text-xl font-bold text-slate-900">{{ ['Sarah Investment', 'Venture Studio', 'Growth Partners', 'Tech Angels', 'Impact Fund', 'AI Ventures', 'Tomorrow Fund', 'Scale Capital', 'Innovation Lab'][$i] }}</h3>
                        <p class="text-sm text-slate-600">{{ ['Angel Investor', 'Venture Capital', 'Angel Syndicate', 'Angel Network', 'Impact Investing', 'Specialized Fund', 'Growth Investing', 'Late Stage', 'Accelerator'][$i] }}</p>
                    </div>

                    <!-- Bio -->
                    <p class="text-sm text-slate-600 mt-4">{{ ['Former Google exec investing in SaaS', 'Focused on early stage founders', 'Strategic investments in AI/ML', 'Angel network with 50+ investors', 'ESG-focused investments', 'AI and deep tech specialist', 'Seed stage focus', 'Series B+ growth deals', 'Hands-on mentorship'][$i] }}</p>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 mt-6 py-4 border-y border-slate-200">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Investments</p>
                            <p class="text-lg font-bold text-slate-900">{{ [24, 18, 45, 32, 28, 15, 52, 38, 22][$i] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Exits</p>
                            <p class="text-lg font-bold text-slate-900">{{ [8, 6, 12, 9, 5, 3, 14, 11, 7][$i] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Sectors</p>
                            <p class="text-lg font-bold text-slate-900">{{ [4, 6, 8, 5, 7, 3, 9, 6, 5][$i] }}</p>
                        </div>
                    </div>

                    <!-- Interests -->
                    <div class="mt-4">
                        <p class="text-xs text-slate-600 font-semibold mb-2">Focus Areas</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ ['SaaS', 'AI/ML', 'FinTech', 'EdTech', 'Climate', 'Web3', 'Healthcare', 'Mobility', 'Enterprise'][$i] }}</span>
                            <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded font-medium">{{ ['B2B', 'B2C', 'Climate', 'Health', 'Data', 'Marketplace', 'Platform', 'Tools', 'DevOps'][$i % 9] }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 space-y-3">
                        <a href="#" class="block w-full px-4 py-2 bg-gradient-primary text-white rounded-lg font-medium text-center hover-glow">
                            View Profile
                        </a>
                        <button class="w-full px-4 py-2 border border-primary-300 text-primary-700 rounded-lg font-medium hover:bg-primary-50 transition-colors">
                            Send Message
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <!-- Load More -->
        <div class="text-center mt-12">
            <button class="px-8 py-3 border-2 border-primary-300 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-colors">
                Load More Investors
            </button>
        </div>
    </div>
</div>
@endsection
