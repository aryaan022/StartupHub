@extends('layouts.main')

@section('title', 'Notifications - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Notifications</h1>
                <p class="text-slate-600 mt-1">Stay updated on important activities</p>
            </div>
            <button class="px-4 py-2 text-slate-600 hover:text-slate-900 font-medium border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                Mark All as Read
            </button>
        </div>

        <!-- Filters -->
        <div class="flex gap-2 mb-8 flex-wrap">
            <button class="px-4 py-2 bg-primary-100 text-primary-700 rounded-full font-medium text-sm hover:bg-primary-200 transition-colors">
                All
            </button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-full font-medium text-sm hover:bg-slate-200 transition-colors">
                Applications
            </button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-full font-medium text-sm hover:bg-slate-200 transition-colors">
                Messages
            </button>
            <button class="px-4 py-2 bg-slate-100 text-slate-700 rounded-full font-medium text-sm hover:bg-slate-200 transition-colors">
                Investments
            </button>
        </div>

        <!-- Notifications List -->
        <div class="space-y-4">
            <!-- Unread Notification -->
            <div class="bg-white rounded-xl shadow-premium border-2 border-primary-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900">New message from Sarah Chen</p>
                        <p class="text-slate-600 text-sm mt-1">Sarah replied to your message: "Let's schedule that meeting next week"</p>
                        <div class="flex gap-3 mt-4">
                            <button class="text-primary-600 hover:text-primary-700 font-medium text-sm">Reply</button>
                            <button class="text-slate-600 hover:text-slate-700 font-medium text-sm">Mark as read</button>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="inline-block w-2 h-2 bg-primary-600 rounded-full"></span>
                        <p class="text-xs text-slate-600 mt-2">Just now</p>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900">You moved forward in TechFlow's hiring process</p>
                        <p class="text-slate-600 text-sm mt-1">You've been shortlisted for the Senior Frontend Developer position. Next: technical interview</p>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-medium text-sm mt-2 inline-block">View Job →</a>
                    </div>
                    <p class="text-xs text-slate-600 flex-shrink-0">2 hours ago</p>
                </div>
            </div>

            <!-- Investment Interest -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900">New investor is interested in your startup</p>
                        <p class="text-slate-600 text-sm mt-1">Venture Partners added your startup to their watchlist. This could lead to an investment opportunity.</p>
                        <div class="flex gap-3 mt-4">
                            <button class="px-4 py-2 bg-primary-50 text-primary-700 rounded font-medium text-sm hover:bg-primary-100">View Profile</button>
                            <button class="text-slate-600 hover:text-slate-700 font-medium text-sm">Dismiss</button>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 flex-shrink-0">Yesterday</p>
                </div>
            </div>

            <!-- Profile View -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900">Someone viewed your profile</p>
                        <p class="text-slate-600 text-sm mt-1">Michael Rodriguez from CloudScale viewed your profile. View his profile back.</p>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-medium text-sm mt-2 inline-block">View Profile →</a>
                    </div>
                    <p class="text-xs text-slate-600 flex-shrink-0">2 days ago</p>
                </div>
            </div>

            <!-- Team Invitation -->
            <div class="bg-white rounded-xl shadow-premium border border-slate-200 p-6 hover:shadow-premium-lg transition-all group cursor-pointer">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.657"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900">You've been invited to join a team</p>
                        <p class="text-slate-600 text-sm mt-1">Alex Kim invited you to join their startup's team as an advisor</p>
                        <div class="flex gap-3 mt-4">
                            <button class="px-4 py-2 bg-primary-600 text-white rounded font-medium text-sm hover:bg-primary-700">Accept</button>
                            <button class="text-slate-600 hover:text-slate-700 font-medium text-sm">Decline</button>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 flex-shrink-0">3 days ago</p>
                </div>
            </div>

            <!-- Weekly Digest -->
            <div class="bg-slate-50 rounded-xl border border-slate-200 p-6">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900">This Week in Startups</p>
                        <p class="text-slate-600 text-sm mt-1">23 new job postings, 5 recommended startups, 2 investor opportunities</p>
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-medium text-sm mt-2 inline-block">Read Digest →</a>
                    </div>
                    <p class="text-xs text-slate-600 flex-shrink-0">Last week</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
