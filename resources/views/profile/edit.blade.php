@extends('layouts.main')

@section('title', 'Edit Profile - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Edit Profile</h1>
            <p class="text-slate-600">Update your personal information and preferences</p>
        </div>

        <!-- Profile Form -->
        <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
            <form class="space-y-8">
                <!-- Profile Picture -->
                <div>
                    <label class="block font-semibold text-slate-900 mb-4">Profile Picture</label>
                    <div class="flex items-center gap-6">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=user" alt="Profile" class="w-20 h-20 rounded-full">
                        <div>
                            <label class="px-6 py-3 bg-primary-50 text-primary-600 rounded-lg font-semibold cursor-pointer hover:bg-primary-100 transition-colors inline-block">
                                Change Photo
                                <input type="file" class="hidden" accept="image/*">
                            </label>
                            <p class="text-sm text-slate-500 mt-2">JPG, PNG or GIF (Max 5MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="border-t border-slate-200 pt-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Personal Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">First Name</label>
                            <input type="text" value="Sarah" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Last Name</label>
                            <input type="text" value="Chen" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Email</label>
                        <input type="email" value="sarah@techflow.ai" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Phone</label>
                        <input type="tel" value="+1 (555) 123-4567" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Bio</label>
                        <textarea rows="4" placeholder="Tell us about yourself..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">AI researcher and entrepreneur. Co-founder of TechFlow.</textarea>
                    </div>
                </div>

                <!-- Role-Specific Information -->
                <div class="border-t border-slate-200 pt-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Role Information</h3>

                    <div class="space-y-6">
                        <!-- Skills -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-3">Skills</label>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium flex items-center gap-2">
                                    Machine Learning
                                    <button type="button" class="hover:text-primary-900">×</button>
                                </span>
                                <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium flex items-center gap-2">
                                    AI/ML
                                    <button type="button" class="hover:text-primary-900">×</button>
                                </span>
                                <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium flex items-center gap-2">
                                    Python
                                    <button type="button" class="hover:text-primary-900">×</button>
                                </span>
                            </div>
                            <input type="text" placeholder="Add new skill..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Years of Experience</label>
                            <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option>Select...</option>
                                <option selected>10+ years</option>
                                <option>5-10 years</option>
                                <option>2-5 years</option>
                                <option>0-2 years</option>
                            </select>
                        </div>

                        <!-- LinkedIn -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">LinkedIn Profile</label>
                            <input type="url" placeholder="https://linkedin.com/in/yourprofile" value="https://linkedin.com/in/sarah-chen" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>

                        <!-- GitHub/Website -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">GitHub/Portfolio</label>
                            <input type="url" placeholder="https://github.com/yourprofile" value="https://github.com/sarah-chen" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>
                </div>

                <!-- Privacy & Notifications -->
                <div class="border-t border-slate-200 pt-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Privacy & Notifications</h3>

                    <div class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Show profile to other users</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Allow investors to contact me</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Receive weekly digest emails</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                            <span class="text-slate-900">Receive marketing emails</span>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-slate-200 pt-8 flex gap-4">
                    <button type="submit" class="px-8 py-3 bg-gradient-primary text-white rounded-lg font-semibold hover-glow">
                        Save Changes
                    </button>
                    <a href="#" class="px-8 py-3 border border-slate-300 text-slate-900 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="mt-12 bg-red-50 border-2 border-red-200 rounded-xl p-8">
            <h3 class="text-lg font-bold text-red-900 mb-4">Danger Zone</h3>
            <p class="text-red-800 mb-6">Irreversible actions</p>

            <div class="flex flex-col md:flex-row gap-4">
                <button class="px-6 py-3 border-2 border-red-300 text-red-700 rounded-lg font-semibold hover:bg-red-100 transition-colors">
                    Reset Password
                </button>
                <button class="px-6 py-3 border-2 border-red-600 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Delete Account
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
