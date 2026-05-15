@extends('layouts.main')

@section('title', 'Admin Dashboard - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Admin Dashboard</h1>
            <p class="text-lg text-slate-600">Manage platform, users, and content</p>
        </div>

        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <p class="text-slate-600 text-sm font-medium">Total Users</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['users'] }}</p>
                <p class="text-sm text-emerald-600 mt-2">Active on platform</p>
            </div>
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <p class="text-slate-600 text-sm font-medium">Active Startups</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['startups'] }}</p>
                <p class="text-sm text-emerald-600 mt-2">Registered on platform</p>
            </div>
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <p class="text-slate-600 text-sm font-medium">Total Jobs</p>
                <p class="text-3xl font-bold text-amber-600 mt-2">{{ $stats['jobs'] }}</p>
                <p class="text-sm text-slate-600 mt-2">Open positions</p>
            </div>
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover-lift">
                <p class="text-slate-600 text-sm font-medium">Applications</p>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['applications'] }}</p>
                <p class="text-sm text-slate-600 mt-2">Submitted</p>
            </div>
        </div>

        <!-- Tabs -->
        <div x-data="{ tab: 'users' }" class="bg-white rounded-xl shadow-premium border border-slate-200">
            <!-- Tab Navigation -->
            <div class="border-b border-slate-200 flex flex-wrap">
                <button 
                    @click="tab = 'users'" 
                    :class="tab === 'users' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Users
                </button>
                <button 
                    @click="tab = 'startups'" 
                    :class="tab === 'startups' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Startups
                </button>
                <button 
                    @click="tab = 'content'" 
                    :class="tab === 'content' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Content Moderation
                </button>
                <button 
                    @click="tab = 'reports'" 
                    :class="tab === 'reports' ? 'bg-primary-50 border-b-2 border-primary-600 text-primary-600' : 'text-slate-600 hover:text-slate-900'"
                    class="px-6 py-4 font-semibold transition-colors"
                >
                    Reports
                </button>
            </div>

            <!-- Tab Content -->
            <div class="p-8">
                <!-- Users Tab -->
                <div x-show="tab === 'users'" class="space-y-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-900">User Management</h3>
                        <div class="flex gap-4">
                            <input type="text" placeholder="Search users..." class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="text-left px-4 py-3 font-semibold text-slate-900">User</th>
                                    <th class="text-left px-4 py-3 font-semibold text-slate-900">Role</th>
                                    <th class="text-left px-4 py-3 font-semibold text-slate-900">Status</th>
                                    <th class="text-left px-4 py-3 font-semibold text-slate-900">Joined</th>
                                    <th class="text-left px-4 py-3 font-semibold text-slate-900">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($recentUsers as $user)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $user->id }}" alt="User" class="w-8 h-8 rounded-full">
                                            <div>
                                                <p class="font-medium text-slate-900">{{ $user->name }}</p>
                                                <p class="text-sm text-slate-600">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 bg-primary-100 text-primary-700 text-xs rounded-full font-semibold">{{ ucfirst($user->role) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-semibold">Active</span>
                                    </td>
                                    <td class="px-4 py-3 text-slate-600">{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('users.show', $user->id) }}" class="text-primary-600 hover:text-primary-700 font-medium">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-slate-600">No users found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Startups Tab -->
                <div x-show="tab === 'startups'" class="space-y-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-900">Startup Verification</h3>
                        <button class="px-4 py-2 bg-slate-100 rounded-lg font-medium hover:bg-slate-200">Filter</button>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentStartups as $startup)
                        <div class="p-4 border border-slate-200 rounded-lg hover:border-slate-300 transition-all group">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                                        {{ substr($startup->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">{{ $startup->name }}</h4>
                                        <p class="text-sm text-slate-600">{{ $startup->industry ?? 'Tech' }} • Registered {{ $startup->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('startups.show', $startup->id) }}" class="px-4 py-2 bg-blue-100 text-blue-700 rounded font-medium hover:bg-blue-200">View</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-slate-600">
                            <p>No startups found</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Content Moderation Tab -->
                <div x-show="tab === 'content'" class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-900">Flagged Content</h3>

                    <div class="space-y-4">
                        @for ($i = 0; $i < 5; $i++)
                        <div class="p-6 border-2 border-red-200 bg-red-50 rounded-lg">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ ['Inappropriate job posting', 'Suspicious profile', 'Spam message', 'Offensive comment', 'Duplicate content'][$i] }}</p>
                                    <p class="text-sm text-slate-600 mt-1">Flagged {{ [2, 4, 1, 3, 5][$i] }} times • Reported by users</p>
                                </div>
                                <span class="px-3 py-1 bg-red-600 text-white text-xs rounded-full font-semibold">{{ ['High', 'Medium', 'Low', 'High', 'Medium'][$i] }}</span>
                            </div>
                            <p class="text-slate-700 mb-4">{{ ['User posted offensive job requirements', 'Profile appears to be fake', 'Mass messaging detected', 'Hate speech in comments', 'Duplicate startup listing'][$i] }}</p>
                            <div class="flex gap-2">
                                <button class="px-4 py-2 bg-red-600 text-white rounded font-medium hover:bg-red-700">Remove</button>
                                <button class="px-4 py-2 border border-red-300 text-red-700 rounded font-medium hover:bg-red-50">Warn User</button>
                                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded font-medium hover:bg-slate-50">Ignore</button>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Reports Tab -->
                <div x-show="tab === 'reports'" class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-900">Analytics & Reports</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-slate-50 rounded-lg p-6 border border-slate-200">
                            <h4 class="font-semibold text-slate-900 mb-4">User Growth (Last 30 Days)</h4>
                            <div class="bg-white rounded p-4 h-40 border border-slate-200 flex items-end justify-around">
                                <div class="w-8 h-16 bg-gradient-primary rounded-t"></div>
                                <div class="w-8 h-20 bg-gradient-primary rounded-t"></div>
                                <div class="w-8 h-24 bg-gradient-primary rounded-t"></div>
                                <div class="w-8 h-28 bg-gradient-primary rounded-t"></div>
                                <div class="w-8 h-32 bg-gradient-primary rounded-t"></div>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-lg p-6 border border-slate-200">
                            <h4 class="font-semibold text-slate-900 mb-4">User Distribution by Role</h4>
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Founders</span>
                                        <span class="font-semibold">35%</span>
                                    </div>
                                    <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full w-35 bg-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Investors</span>
                                        <span class="font-semibold">25%</span>
                                    </div>
                                    <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full w-25 bg-emerald-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Job Seekers</span>
                                        <span class="font-semibold">40%</span>
                                    </div>
                                    <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full w-40 bg-purple-500 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-slate-200 p-6">
                        <h4 class="font-semibold text-slate-900 mb-4">Recent Activity</h4>
                        <div class="space-y-3">
                            <p class="text-sm text-slate-600">2,841 new signups this week</p>
                            <p class="text-sm text-slate-600">427 startup profiles created</p>
                            <p class="text-sm text-slate-600">1,234 job applications submitted</p>
                            <p class="text-sm text-slate-600">89 investments recorded</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
