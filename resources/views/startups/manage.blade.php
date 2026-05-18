@extends('layouts.main')

@section('title', 'Manage Startup - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Manage Your Startup</h1>
            <p class="text-slate-600">Update company information, team, and settings</p>
        </div>

        <!-- Navigation Tabs -->
        <div x-data="{ tab: 'basics' }" class="bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden">
            <!-- Tabs -->
            <div class="border-b border-slate-200 flex flex-wrap">
                <button 
                    @click="tab = 'basics'" 
                    :class="tab === 'basics' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Basic Info
                </button>
                <button 
                    @click="tab = 'team'" 
                    :class="tab === 'team' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Team
                </button>
                <button 
                    @click="tab = 'funding'" 
                    :class="tab === 'funding' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Funding
                </button>
                <button 
                    @click="tab = 'jobs'" 
                    :class="tab === 'jobs' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Jobs
                </button>
                <button 
                    @click="tab = 'settings'" 
                    :class="tab === 'settings' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Settings
                </button>
            </div>

            <!-- Tab Content -->
            <div class="p-8">
                <!-- Basic Info -->
                <div x-show="tab === 'basics'" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Company Logo</label>
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 bg-gradient-primary rounded-lg flex items-center justify-center text-white text-3xl font-bold">T</div>
                            <button class="px-6 py-2 bg-primary-50 text-primary-600 rounded-lg font-medium hover:bg-primary-100 transition-colors">
                                Upload Logo
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Company Name</label>
                            <input type="text" value="TechFlow" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Industry</label>
                            <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option>Software</option>
                                <option selected>AI/ML</option>
                                <option>FinTech</option>
                                <option>SaaS</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                        <textarea rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">AI-powered workflow automation platform that reduces manual work by 80%</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Website</label>
                            <input type="url" value="https://techflow.ai" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Founded</label>
                            <input type="date" value="2021-01-15" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>

                    <button class="px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                        Save Changes
                    </button>
                </div>

                <!-- Team -->
                <div x-show="tab === 'team'" class="space-y-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-slate-900 text-lg">Team Members</h3>
                        <button class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                            + Add Member
                        </button>
                    </div>

                    @if($startup->teamMembers->count() > 0)
                    <div class="space-y-4">
                        @foreach($startup->teamMembers as $member)
                        <div class="p-4 border border-slate-200 rounded-lg flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $member->name }}</p>
                                    <p class="text-sm text-slate-600">{{ $member->role }}</p>
                                </div>
                            </div>
                            <form method="POST" action="#" onclick="return confirm('Remove member?')">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium">Remove</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12 bg-slate-50 rounded-lg border border-slate-200">
                        <p class="text-slate-600 mb-4">No team members added yet</p>
                        <button class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                            Add Team Member
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Funding -->
                <div x-show="tab === 'funding'" class="space-y-6">
                    <h3 class="font-bold text-slate-900 text-lg">Funding History</h3>

                    <div class="space-y-4">
                        <div class="p-4 border border-slate-200 rounded-lg">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <p class="font-semibold text-slate-900">Series A</p>
                                    <p class="text-sm text-slate-600">January 2023</p>
                                </div>
                                <button class="text-red-600 hover:text-red-700">Remove</button>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs text-slate-600">Amount</p>
                                    <p class="font-semibold">$8.5M</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-600">Valuation</p>
                                    <p class="font-semibold">$50M</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-600">Lead</p>
                                    <p class="font-semibold">Venture Fund</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="px-4 py-2 border border-primary-300 text-primary-600 rounded-lg font-medium hover:bg-primary-50">
                        + Add Funding Round
                    </button>
                </div>

                <!-- Jobs -->
                <div x-show="tab === 'jobs'" class="space-y-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-slate-900 text-lg">Job Postings</h3>
                        <a href="#" class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700">
                            + Post Job
                        </a>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 border border-slate-200 rounded-lg flex items-center justify-between">
                            <div class="flex-1">
                                <p class="font-semibold text-slate-900">Senior Frontend Developer</p>
                                <p class="text-sm text-slate-600">Remote • Full-time</p>
                                <span class="inline-block px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded mt-2 font-medium">Active</span>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">Edit</button>
                                <button class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">View</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div x-show="tab === 'settings'" class="space-y-6">
                    <div>
                        <h3 class="font-bold text-slate-900 mb-4">Visibility</h3>
                        <label class="flex items-center gap-3 cursor-pointer mb-4">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Make company visible on platform</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Allow investors to contact you</span>
                        </label>
                    </div>

                    <div class="border-t border-slate-200 pt-6">
                        <h3 class="font-bold text-slate-900 mb-4">Danger Zone</h3>
                        <button class="px-6 py-3 border-2 border-red-300 bg-red-50 text-red-700 rounded-lg font-semibold hover:bg-red-100 transition-colors">
                            Delete Company Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
