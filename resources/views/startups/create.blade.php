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
        <form action="{{ route('startups.store') }}" method="POST" enctype="multipart/form-data" x-data="{ step: 1, name: '', industry: '', short_description: '', description: '', founded_at: '', city: '', country: '', website_url: '', stage: 'seed', logo: null }" class="mb-12">
            @csrf
            <div class="flex gap-4 mb-8">
                <template x-for="i in 4" :key="i">
                    <div class="flex-1">
                        <div 
                            :class="step >= i ? 'bg-blue-600' : 'bg-slate-300'"
                            class="h-2 rounded-full transition-all"
                        ></div>
                        <p :class="step >= i ? 'text-blue-600' : 'text-slate-600'" class="text-xs font-semibold mt-2">
                            <span x-text="['Basics', 'Details', 'Team', 'Review'][i-1]"></span>
                        </p>
                    </div>
                </template>
            </div>                                                          

            <!-- Step 1: Basics -->
            <div x-show="step === 1" class="bg-white rounded-xl shadow-lg border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Basic Information</h2>

                <div class="space-y-6 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Company Name *</label>
                        <input type="text" name="name" x-model="name" placeholder="Your amazing startup..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Industry *</label>
                        <select name="industry" x-model="industry" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select an industry</option>
                            <option value="AI/ML">AI/ML</option>
                            <option value="SaaS">SaaS</option>
                            <option value="FinTech">FinTech</option>
                            <option value="EdTech">EdTech</option>
                            <option value="HealthTech">HealthTech</option>
                            <option value="E-commerce">E-commerce</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('industry') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Short Description *</label>
                        <textarea name="short_description" x-model="short_description" placeholder="What does your startup do?" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        @error('short_description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Full Description *</label>
                        <textarea name="description" x-model="description" placeholder="Detailed information about your startup..." rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Founding Date</label>
                            <input type="date" name="founded_at" x-model="founded_at" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">City</label>
                            <input type="text" name="city" x-model="city" placeholder="San Francisco" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" @click="step = 2" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                        Next →
                    </button>
                </div>
            </div>

            <!-- Step 2: Details -->
            <div x-show="step === 2" class="bg-white rounded-xl shadow-lg border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Company Details</h2>

                <div class="space-y-6 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Website</label>
                        <input type="url" name="website_url" x-model="website_url" placeholder="https://example.com" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Company Logo</label>
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-8 text-center cursor-pointer hover:border-blue-500 transition-colors" onclick="document.getElementById('logo-input').click()">
                            <svg class="w-12 h-12 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p class="text-slate-600">Drag and drop or click to upload</p>
                            <input type="file" id="logo-input" name="logo" @change="logo = $event.target.files[0]" accept="image/*" class="hidden">
                            <p class="text-xs text-slate-500 mt-2" x-show="logo" x-text="logo?.name"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Current Stage *</label>
                        <select name="stage" x-model="stage" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="idea">Idea</option>
                            <option value="pre_seed">Pre-seed</option>
                            <option value="seed">Seed</option>
                            <option value="series_a">Series A</option>
                            <option value="series_b">Series B</option>
                            <option value="series_c">Series C</option>
                            <option value="growth">Growth</option>
                            <option value="exit">Exit</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Country</label>
                        <input type="text" name="country" x-model="country" placeholder="USA" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="button" @click="step = 1" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50">
                        ← Back
                    </button>
                    <button type="button" @click="step = 3" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                        Next →
                    </button>
                </div>
            </div>

            <!-- Step 3: Summary -->
            <div x-show="step === 3" class="bg-white rounded-xl shadow-lg border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Review & Create</h2>

                <div class="space-y-6 mb-8">
                    <div class="p-6 bg-slate-50 rounded-lg border border-slate-200">
                        <h3 class="font-semibold text-slate-900 mb-4">Summary</h3>
                        <div class="space-y-3 text-sm">
                            <p><span class="text-slate-600">Company:</span> <span class="font-semibold text-slate-900" x-text="name || 'N/A'"></span></p>
                            <p><span class="text-slate-600">Industry:</span> <span class="font-semibold text-slate-900" x-text="industry || 'N/A'"></span></p>
                            <p><span class="text-slate-600">Location:</span> <span class="font-semibold text-slate-900" x-text="(city && country) ? `${city}, ${country}` : 'N/A'"></span></p>
                            <p><span class="text-slate-600">Stage:</span> <span class="font-semibold text-slate-900" x-text="stage || 'N/A'"></span></p>
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
                        <input type="checkbox" class="w-4 h-4 text-blue-600 rounded" required>
                        <span class="text-slate-900">I agree to the Terms of Service</span>
                    </label>
                </div>

                <div class="flex justify-between">
                    <button type="button" @click="step = 2" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50">
                        ← Back
                    </button>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                        Create Startup
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
