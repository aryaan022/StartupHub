@extends('layouts.main')

@section('title', 'Create New Startup - StartupHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-primary-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Create Your Startup</h1>
            <p class="text-lg text-slate-600">Join the startup ecosystem in just a few minutes</p>
        </div>

        <!-- Progress -->
        <div x-data="{ step: 1 }" class="mb-12">
            <div class="flex gap-4 mb-8">
                <template x-for="i in 4" :key="i">
                    <div class="flex-1">
                        <div 
                            :class="step >= i ? 'bg-gradient-primary' : 'bg-slate-300'"
                            class="h-2 rounded-full transition-all"
                        ></div>
                        <p :class="step >= i ? 'text-primary-600' : 'text-slate-600'" class="text-xs font-semibold mt-2">
                            <span x-text="['Basics', 'Details', 'Team', 'Review'][i-1]"></span>
                        </p>
                    </div>
                </template>
            </div>

            <!-- Step 1: Basics -->
            <div x-show="step === 1" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Basic Information</h2>

                <div class="space-y-6 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Company Name *</label>
                        <input type="text" placeholder="Your amazing startup..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Industry *</label>
                        <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="">Select an industry</option>
                            <option>AI/ML</option>
                            <option>SaaS</option>
                            <option>FinTech</option>
                            <option>EdTech</option>
                            <option>HealthTech</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Short Description *</label>
                        <textarea placeholder="What does your startup do?" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Founding Date *</label>
                            <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Headquarters</label>
                            <input type="text" placeholder="City, Country" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button @click="step = 2" class="px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                        Next →
                    </button>
                </div>
            </div>

            <!-- Step 2: Details -->
            <div x-show="step === 2" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Company Details</h2>

                <div class="space-y-6 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Website</label>
                        <input type="url" placeholder="https://example.com" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Company Logo</label>
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-8 text-center cursor-pointer hover:border-primary-500 transition-colors">
                            <svg class="w-12 h-12 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p class="text-slate-600">Drag and drop or click to upload</p>
                            <input type="file" class="hidden" accept="image/*">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Current Stage *</label>
                        <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option>Idea/Pre-seed</option>
                            <option selected>Seed funded</option>
                            <option>Series A</option>
                            <option>Series B+</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Team Size</label>
                        <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option>1-5</option>
                            <option selected>6-15</option>
                            <option>16-30</option>
                            <option>30+</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between">
                    <button @click="step = 1" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                        ← Back
                    </button>
                    <button @click="step = 3" class="px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                        Next →
                    </button>
                </div>
            </div>

            <!-- Step 3: Team -->
            <div x-show="step === 3" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Add Team Members</h2>

                <div class="space-y-6 mb-8">
                    <div class="p-4 border-2 border-dashed border-primary-300 bg-primary-50 rounded-lg">
                        <p class="text-primary-700 font-medium text-center">You are the founder and admin</p>
                    </div>

                    <div class="border-2 border-dashed border-slate-300 rounded-lg p-8 text-center cursor-pointer hover:border-primary-500 transition-colors">
                        <svg class="w-12 h-12 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <p class="text-slate-600 font-medium">Invite team members</p>
                        <p class="text-sm text-slate-600">Enter emails to invite teammates</p>
                        <input type="email" placeholder="teammate@example.com" class="w-full px-4 py-2 border border-slate-300 rounded-lg mt-4 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer p-4 border border-slate-200 rounded-lg hover:bg-slate-50">
                        <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                        <span class="text-slate-900">I'll add team members later</span>
                    </label>
                </div>

                <div class="flex justify-between">
                    <button @click="step = 2" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                        ← Back
                    </button>
                    <button @click="step = 4" class="px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                        Next →
                    </button>
                </div>
            </div>

            <!-- Step 4: Review -->
            <div x-show="step === 4" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Review & Create</h2>

                <div class="space-y-6 mb-8">
                    <div class="p-6 bg-slate-50 rounded-lg border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Summary</h3>
                        <div class="space-y-3 text-sm">
                            <p><span class="text-slate-600">Company:</span> <span class="font-semibold text-slate-900">TechFlow</span></p>
                            <p><span class="text-slate-600">Industry:</span> <span class="font-semibold text-slate-900">AI/ML</span></p>
                            <p><span class="text-slate-600">Location:</span> <span class="font-semibold text-slate-900">San Francisco, CA</span></p>
                            <p><span class="text-slate-600">Stage:</span> <span class="font-semibold text-slate-900">Seed funded</span></p>
                        </div>
                    </div>

                    <div class="p-6 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-blue-800">By creating a startup profile, you agree to our Terms of Service and will gain access to the full StartupHub ecosystem.</p>
                        </div>
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                        <span class="text-slate-900">I agree to the Terms of Service</span>
                    </label>
                </div>

                <div class="flex justify-between">
                    <button @click="step = 3" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                        ← Back
                    </button>
                    <a href="{{ route('dashboard') }}" class="inline-block px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                        Create Startup
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
