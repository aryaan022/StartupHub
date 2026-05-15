@extends('layouts.main')

@section('title', 'Create Account - StartupHub')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-50 via-primary-50/30 to-slate-50">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-8">
                <div class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center text-white font-bold">
                    S
                </div>
                <span class="font-bold text-xl text-slate-900">StartupHub</span>
            </a>
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Join the startup ecosystem</h1>
            <p class="text-lg text-slate-600">Choose your role to get started</p>
        </div>

        <!-- Role Selection -->
        <div x-data="{ 
            selectedRole: 'founder',
            roles: {
                founder: {
                    title: 'I am a Founder',
                    description: 'Building a startup and looking to raise capital or hire talent',
                    icon: 'rocket',
                    color: 'blue'
                },
                investor: {
                    title: 'I am an Investor',
                    description: 'Looking for investment opportunities and portfolio companies',
                    icon: 'trending-up',
                    color: 'emerald'
                },
                job_seeker: {
                    title: 'I am a Job Seeker',
                    description: 'Looking for exciting opportunities at startups',
                    icon: 'briefcase',
                    color: 'purple'
                },
                partner: {
                    title: 'I am a Partner',
                    description: 'Providing services or resources to the startup community',
                    icon: 'handshake',
                    color: 'orange'
                }
            }
        }" class="space-y-12">
            <!-- Role Selection Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <template x-for="(role, key) in roles" :key="key">
                    <button
                        @click="selectedRole = key"
                        :class="selectedRole === key ? 'ring-2 ring-offset-2 ring-primary-500 border-primary-300 shadow-premium' : 'border-slate-200'"
                        class="relative p-6 bg-white rounded-xl border-2 text-left transition-all hover:border-slate-300"
                    >
                        <!-- Corner Badge -->
                        <div :class="'absolute top-4 right-4 w-8 h-8 rounded-full flex items-center justify-center ' + (selectedRole === key ? 'bg-gradient-primary text-white' : 'bg-slate-100')" x-show="selectedRole === key">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 mb-2" x-text="role.title"></h3>
                        <p class="text-slate-600" x-text="role.description"></p>
                    </button>
                </template>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="/register" class="bg-white rounded-2xl shadow-premium border border-slate-200 p-8 md:p-12 animate-slideUp">
                @csrf

                <!-- Hidden Role Input -->
                <input type="hidden" name="role" :value="selectedRole" x-model="selectedRole">

                <!-- Form Title -->
                <h2 class="text-2xl font-bold text-slate-900 mb-8">Create your account</h2>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-slate-900 mb-2">
                            First Name
                        </label>
                        <input 
                            type="text" 
                            name="first_name" 
                            id="first_name" 
                            required
                            value="{{ old('first_name') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="John"
                        >
                        @error('first_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-slate-900 mb-2">
                            Last Name
                        </label>
                        <input 
                            type="text" 
                            name="last_name" 
                            id="last_name" 
                            required
                            value="{{ old('last_name') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="Doe"
                        >
                        @error('last_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-slate-900 mb-2">
                        Email address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-900 mb-2">
                            Password
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="••••••••"
                        >
                        <p class="mt-2 text-xs text-slate-600">At least 8 characters</p>
                        @error('password')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-900 mb-2">
                            Confirm Password
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 text-slate-900 placeholder-slate-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="••••••••"
                        >
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start mb-8">
                    <input 
                        type="checkbox" 
                        name="agree" 
                        id="agree"
                        required
                        class="w-4 h-4 mt-1 text-primary-600 bg-slate-50 border-slate-300 rounded focus:ring-2 focus:ring-primary-500"
                    >
                    <label for="agree" class="ml-3 text-sm text-slate-700">
                        I agree to the
                        <a href="#" class="font-semibold text-primary-600 hover:text-primary-700">Terms of Service</a>
                        and
                        <a href="#" class="font-semibold text-primary-600 hover:text-primary-700">Privacy Policy</a>
                    </label>
                </div>

                <!-- Sign Up Button -->
                <button 
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow transition-all mb-4"
                >
                    Create Account
                </button>

                <!-- Sign In Link -->
                <p class="text-center text-slate-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-700">
                        Sign in
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Alpine.js will handle the role selection
</script>
@endpush
@endsection
