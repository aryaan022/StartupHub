@extends('layouts.main')

@section('title', 'Settings - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900">Settings</h1>
            <p class="text-slate-600 mt-2">Manage your account and preferences</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="md:col-span-1">
                <nav class="sticky top-24 space-y-2 bg-white rounded-xl shadow-premium border border-slate-200 p-4">
                    <a href="#account" class="block px-4 py-3 text-primary-600 bg-primary-50 rounded-lg font-medium">Account</a>
                    <a href="#privacy" class="block px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-colors">Privacy</a>
                    <a href="#notifications" class="block px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-colors">Notifications</a>
                    <a href="#security" class="block px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-colors">Security</a>
                    <a href="#integrations" class="block px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-colors">Integrations</a>
                    <a href="#billing" class="block px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg font-medium transition-colors">Billing</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-3 space-y-8">
                <!-- Account Settings -->
                <div id="account" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Account Settings</h2>

                    <div class="space-y-6 pb-8 border-b border-slate-200">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Email</label>
                            <div class="flex gap-2">
                                <input type="email" value="sarah@techflow.ai" disabled class="flex-1 px-4 py-2 border border-slate-300 rounded-lg bg-slate-50" />
                                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg font-medium hover:bg-slate-50 transition-colors">Change</button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Username</label>
                            <div class="flex gap-2">
                                <input type="text" value="sarah.chen" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" />
                                <button class="px-6 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors">Save</button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Display Name</label>
                            <input type="text" value="Sarah Chen" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" />
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="font-semibold text-slate-900 mb-4">Account Type</h3>
                        <div class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg bg-slate-50">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Founder</span>
                            <p class="text-slate-700 flex-1">You're signed up as a Founder</p>
                            <button class="text-primary-600 hover:text-primary-700 font-medium">Switch Role</button>
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings -->
                <div id="privacy" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Privacy Settings</h2>
                    <div class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Make my profile visible to other users</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Allow others to find me using my email</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                            <span class="text-slate-900">Allow investors to see my startup metrics</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                            <span class="text-slate-900">Opt-out of analytics and improvement programs</span>
                        </label>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div id="notifications" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Notification Preferences</h2>

                    <div class="space-y-6">
                        <div>
                            <h3 class="font-semibold text-slate-900 mb-3">Email Notifications</h3>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                    <span class="text-slate-900">New messages</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                    <span class="text-slate-900">Job application updates</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                    <span class="text-slate-900">Investor interest in your startup</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                    <span class="text-slate-900">Weekly digest</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded">
                                    <span class="text-slate-900">Marketing emails</span>
                                </label>
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-6">
                            <h3 class="font-semibold text-slate-900 mb-3">In-App Notifications</h3>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                    <span class="text-slate-900">Show notifications</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded" checked>
                                    <span class="text-slate-900">Desktop notifications</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div id="security" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Security</h2>

                    <div class="space-y-6">
                        <div>
                            <h3 class="font-semibold text-slate-900 mb-3">Password</h3>
                            <button class="px-6 py-2 border border-slate-300 text-slate-900 rounded-lg font-medium hover:bg-slate-50 transition-colors">
                                Change Password
                            </button>
                        </div>

                        <div class="border-t border-slate-200 pt-6">
                            <h3 class="font-semibold text-slate-900 mb-3">Two-Factor Authentication</h3>
                            <p class="text-slate-600 mb-4">Add an extra layer of security to your account</p>
                            <button class="px-6 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors">
                                Enable 2FA
                            </button>
                        </div>

                        <div class="border-t border-slate-200 pt-6">
                            <h3 class="font-semibold text-slate-900 mb-3">Active Sessions</h3>
                            <div class="space-y-3">
                                <div class="p-4 border border-slate-200 rounded-lg flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-slate-900">Chrome on macOS</p>
                                        <p class="text-sm text-slate-600">Last active: Just now</p>
                                    </div>
                                    <span class="text-xs text-emerald-600 font-semibold">Current</span>
                                </div>
                                <div class="p-4 border border-slate-200 rounded-lg flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-slate-900">Safari on iPhone</p>
                                        <p class="text-sm text-slate-600">Last active: 2 days ago</p>
                                    </div>
                                    <button class="text-red-600 hover:text-red-700 text-sm font-medium">Sign out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Integrations -->
                <div id="integrations" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Integrations</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-6 border border-slate-200 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-slate-900">Google</h3>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-semibold">Connected</span>
                            </div>
                            <p class="text-sm text-slate-600 mb-4">Import calendar events and sync contacts</p>
                            <button class="text-red-600 hover:text-red-700 font-medium text-sm">Disconnect</button>
                        </div>

                        <div class="p-6 border border-slate-200 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-slate-900">GitHub</h3>
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs rounded-full font-semibold">Not Connected</span>
                            </div>
                            <p class="text-sm text-slate-600 mb-4">Connect to showcase your contributions</p>
                            <button class="px-4 py-2 bg-primary-600 text-white rounded font-medium text-sm hover:bg-primary-700">Connect</button>
                        </div>
                    </div>
                </div>

                <!-- Billing -->
                <div id="billing" class="bg-white rounded-xl shadow-premium border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Billing & Plan</h2>

                    <div class="p-6 bg-slate-50 rounded-lg border border-slate-200 mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-slate-900">Starter Plan</h3>
                                <p class="text-sm text-slate-600 mt-1">You're currently on the Starter plan</p>
                            </div>
                            <span class="font-bold text-slate-900">Free</span>
                        </div>
                        <button class="text-primary-600 hover:text-primary-700 font-medium">Upgrade Plan</button>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-900 mb-4">Billing History</h3>
                        <div class="space-y-2 text-sm">
                            <p class="text-slate-600">You haven't made any payments yet. Upgrade to a paid plan to see billing history.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
