@extends('layouts.main')

@section('title', 'Edit Profile - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Edit Profile</h1>
            <p class="text-slate-600">Update your personal information and preferences</p>
        </div>

        <!-- Profile Form -->
        <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('POST')

                <!-- Profile Picture -->
                <div>
                    <label class="block font-semibold text-slate-900 mb-4">Profile Picture</label>
                    <div class="flex items-center gap-6">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="Profile" class="w-20 h-20 rounded-full object-cover">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-2xl">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <label class="px-6 py-3 bg-primary-50 text-primary-600 rounded-lg font-semibold cursor-pointer hover:bg-primary-100 transition-colors inline-block">
                                Change Photo
                                <input type="file" name="avatar" class="hidden" accept="image/*">
                            </label>
                            <p class="text-sm text-slate-500 mt-2">JPG, PNG or GIF (Max 2MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="border-t border-slate-200 pt-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Personal Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('first_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('last_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Email</label>
                        <input type="email" value="{{ $user->email }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-slate-100 cursor-not-allowed" disabled>
                        <p class="text-sm text-slate-500 mt-1">Email cannot be changed</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+1 (555) 123-4567" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Bio</label>
                        <textarea rows="4" name="bio" placeholder="Tell us about yourself..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-slate-200 pt-8 flex gap-4">
                    <button type="submit" class="px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover:opacity-90 transition-all">
                        Save Changes
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="mt-12 bg-white rounded-xl shadow-premium border border-slate-200 p-8">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Change Password</h3>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">
                @csrf
                @method('POST')

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Current Password *</label>
                    <input type="password" name="current_password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                    @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">New Password *</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                    @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Confirm Password *</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                </div>

                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                    Update Password
                </button>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="mt-12 bg-red-50 border-2 border-red-200 rounded-xl p-8">
            <h3 class="text-lg font-bold text-red-900 mb-4">Danger Zone</h3>
            <p class="text-red-800 mb-6">Irreversible actions. Once deleted, your account and all data cannot be recovered.</p>

            <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 border-2 border-red-600 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
