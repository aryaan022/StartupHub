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
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-semibold">Actively Fundraising</span>
                            <h2 class="text-2xl font-bold text-slate-900 mt-3 group-hover:text-primary-600 transition-colors">Series B Round - $20M Target</h2>
                            <p class="text-slate-600 text-lg mt-1">CloudScale</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-slate-600">Progress</p>
                            <p class="text-2xl font-bold text-slate-900">$14.2M</p>
                            <p class="text-xs text-slate-600">raised so far</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full w-71 bg-gradient-primary rounded-full"></div>
                        </div>
                        <p class="text-sm text-slate-600 mt-2">71% of goal • Closes in 45 days</p>
                    </div>

                    <p class="text-slate-700 mb-6">Leading cloud infrastructure company is raising Series B to expand into new markets. Series A investors and select new investors invited.</p>

                    <div class="flex flex-wrap gap-4 mb-6 pb-6 border-b border-slate-200">
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Minimum</p>
                            <p class="font-bold text-slate-900">$500k</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Valuation</p>
                            <p class="font-bold text-slate-900">$85M</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Type</p>
                            <p class="font-bold text-slate-900">Equity</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-semibold">Stage</p>
                            <p class="font-bold text-slate-900">Series B</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="#" class="px-6 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                            Learn More
                        </a>
                        <a href="#" class="px-6 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                            Express Interest
                        </a>
                    </div>
                </div>

                <!-- More Rounds -->
                @for ($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <span class="px-3 py-1 bg-primary-100 text-primary-700 text-xs rounded-full font-semibold">Open</span>
                            <h3 class="text-xl font-bold text-slate-900 mt-3 group-hover:text-primary-600 transition-colors">{{ ['Seed Round - $3M Target', 'Series A Round - $10M Target', 'Seed Round - $2M Target'][$i] }}</h3>
                            <p class="text-slate-600 mt-1">{{ ['Astra AI', 'InnovateLabs', 'DataStream'][$i] }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-slate-900">{{ ['$1.8M', '$7.2M', '$1.2M'][$i] }}/{{ ['$3M', '$10M', '$2M'][$i] }}</p>
                            <p class="text-xs text-slate-600">{{ [60, 72, 60][$i] }}% funded</p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Investors -->
            <div x-show="tab === 'investors'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 0; $i < 9; $i++)
                <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full mx-auto flex items-center justify-center text-white text-2xl font-bold mb-4">
                            {{ chr(65 + $i) }}
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg">{{ ['Venture Partners', 'Growth Equity Fund', 'Angel Syndicate', 'Impact Ventures', 'Tech Fund', 'Global VC', 'Startup Accelerator', 'Enterprise Fund', 'AI Focused Fund'][$i] }}</h3>
                        <p class="text-sm text-slate-600 mt-2">{{ ['$500M AUM', '$200M AUM', '$50M AUM', '$300M AUM', '$150M AUM', '$1B AUM', '$75M AUM', '$400M AUM', '$250M AUM'][$i] }}</p>
                    </div>

                    <div class="space-y-3 border-y border-slate-200 py-4 mb-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ ['Seed to Series C', 'Early stage', 'Pre-seed to Seed', 'Series A+', 'All stages', 'Growth stage', 'Early stage', 'Series B+', 'All AI/ML'][$i] }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ ['US-based', 'Global', 'Europe focus', 'US & Asia', 'Global', 'US focus', 'Europe', 'US & Europe', 'Global'][$i] }}</span>
                        </div>
                    </div>

                    <a href="#" class="block w-full px-4 py-2 bg-primary-50 text-primary-700 rounded-lg font-medium text-center hover:bg-primary-100 transition-colors">
                        View Portfolio
                    </a>
                </div>
                @endfor
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
