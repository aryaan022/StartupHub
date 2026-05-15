@extends('layouts.main')

@section('title', 'Post a Job - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('dashboard') }}" class="text-primary-600 hover:text-primary-700 font-semibold flex items-center gap-2 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
            <h1 class="text-4xl font-bold text-slate-900">Post a Job</h1>
            <p class="text-lg text-slate-600 mt-2">Find the right talent for your startup</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
            <form action="{{ route('jobs.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Select Startup -->
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">
                        Which startup is this job for? *
                    </label>
                    <select name="startup_id" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">-- Select a startup --</option>
                        @foreach(Auth::user()->startups ?? [] as $startup)
                            <option value="{{ $startup->id }}">{{ $startup->name }}</option>
                        @endforeach
                    </select>
                    @error('startup_id')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Title -->
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">Job Title *</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title') }}"
                        placeholder="e.g., Senior Full Stack Developer"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Type & Experience Level -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-3">Job Type *</label>
                        <select name="job_type" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="">Select type</option>
                            <option value="full_time">Full-time</option>
                            <option value="part_time">Part-time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                        </select>
                        @error('job_type')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-3">Experience Level *</label>
                        <select name="experience_level" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="">Select level</option>
                            <option value="entry">Entry Level</option>
                            <option value="junior">Junior</option>
                            <option value="mid">Mid Level</option>
                            <option value="senior">Senior</option>
                        </select>
                        @error('experience_level')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">Job Description *</label>
                    <textarea 
                        name="description" 
                        rows="6"
                        placeholder="Describe the role, responsibilities, and what you're looking for..."
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Salary Range -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-3">Salary Min (USD)</label>
                        <input 
                            type="number" 
                            name="salary_min" 
                            value="{{ old('salary_min') }}"
                            placeholder="e.g., 100000"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-3">Salary Max (USD)</label>
                        <input 
                            type="number" 
                            name="salary_max" 
                            value="{{ old('salary_max') }}"
                            placeholder="e.g., 150000"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                    </div>
                </div>

                <!-- Remote Type & Location -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-3">Remote Type *</label>
                        <select name="remote_type" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="">Select type</option>
                            <option value="remote">Fully Remote</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="onsite">On-site</option>
                        </select>
                        @error('remote_type')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-3">Location</label>
                        <input 
                            type="text" 
                            name="location" 
                            value="{{ old('location') }}"
                            placeholder="e.g., San Francisco, CA"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                    </div>
                </div>

                <!-- Requirements -->
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">Requirements</label>
                    <textarea 
                        name="requirements" 
                        rows="4"
                        placeholder="List key requirements..."
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                    >{{ old('requirements') }}</textarea>
                </div>

                <!-- Benefits -->
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">Benefits</label>
                    <textarea 
                        name="benefits" 
                        rows="4"
                        placeholder="List benefits and perks..."
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                    >{{ old('benefits') }}</textarea>
                </div>

                <!-- Skills Required -->
                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">Required Skills (comma-separated)</label>
                    <input 
                        type="text" 
                        name="skills" 
                        value="{{ old('skills') }}"
                        placeholder="e.g., Laravel, React, PostgreSQL"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                    >
                </div>

                <!-- Submit -->
                <div class="flex gap-4">
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg font-semibold hover:shadow-lg transition-all"
                    >
                        Post Job
                    </button>
                    <a 
                        href="{{ route('dashboard') }}"
                        class="flex-1 px-6 py-3 border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition-all text-center"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
