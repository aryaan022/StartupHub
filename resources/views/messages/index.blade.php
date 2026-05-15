@extends('layouts.main')

@section('title', 'Messages - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Messages</h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 h-[600px]">
            <!-- Conversations List -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden flex flex-col">
                <!-- Search -->
                <div class="p-4 border-b border-slate-200">
                    <input 
                        type="text" 
                        placeholder="Search conversations..." 
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm"
                    >
                </div>

                <!-- Conversations -->
                <div class="flex-1 overflow-y-auto">
                    @for ($i = 0; $i < 8; $i++)
                    <div class="p-3 border-b border-slate-100 hover:bg-primary-50 cursor-pointer transition-colors {{ $i === 0 ? 'bg-primary-50 border-l-4 border-l-primary-600' : '' }}">
                        <div class="flex items-center gap-3">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $i }}" alt="User" class="w-10 h-10 rounded-full flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 truncate">{{ ['John Smith', 'Sarah Johnson', 'Mike Chen', 'Emma Wilson', 'Alex Rodriguez', 'Lisa Anderson', 'James Martinez', 'Sophie Taylor'][$i] }}</p>
                                <p class="text-xs text-slate-600 truncate">{{ ['Hey, when can we chat?', 'About your application...', 'Let\'s schedule a call', 'Thanks for connecting!', 'Interested in your startup', 'Updated presentation', 'Great meeting today', 'Looking forward to it'][$i] }}</p>
                            </div>
                            @if ($i === 0)
                            <div class="w-2 h-2 bg-primary-600 rounded-full flex-shrink-0"></div>
                            @endif
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Chat Window -->
            <div class="lg:col-span-3 bg-white rounded-xl shadow-premium border border-slate-200 overflow-hidden flex flex-col">
                <!-- Chat Header -->
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="User" class="w-10 h-10 rounded-full">
                        <div>
                            <h2 class="font-semibold text-slate-900">John Smith</h2>
                            <p class="text-xs text-slate-600">Active now</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </button>
                        <button class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-slate-50">
                    <!-- Received Message -->
                    <div class="flex gap-3">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="User" class="w-8 h-8 rounded-full flex-shrink-0 mt-1">
                        <div class="flex-1">
                            <div class="bg-white border border-slate-200 rounded-lg px-4 py-2 inline-block max-w-xs">
                                <p class="text-slate-900">Hey! Looking at your startup idea, it sounds really interesting.</p>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">10:23 AM</p>
                        </div>
                    </div>

                    <!-- Sent Message -->
                    <div class="flex gap-3 justify-end">
                        <div class="flex-1">
                            <div class="bg-gradient-primary text-white rounded-lg px-4 py-2 inline-block max-w-xs">
                                <p>Thanks! We've been working on it for 6 months now</p>
                            </div>
                            <p class="text-xs text-slate-600 mt-1 text-right">10:25 AM</p>
                        </div>
                    </div>

                    <!-- Received Message -->
                    <div class="flex gap-3">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="User" class="w-8 h-8 rounded-full flex-shrink-0 mt-1">
                        <div class="flex-1">
                            <div class="bg-white border border-slate-200 rounded-lg px-4 py-2 inline-block max-w-xs">
                                <p class="text-slate-900">Would you be open to a meeting? I think we could be a good fit for investment.</p>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">10:27 AM</p>
                        </div>
                    </div>

                    <!-- Sent Message -->
                    <div class="flex gap-3 justify-end">
                        <div class="flex-1">
                            <div class="bg-gradient-primary text-white rounded-lg px-4 py-2 inline-block max-w-xs">
                                <p>Absolutely! How about next week?</p>
                            </div>
                            <p class="text-xs text-slate-600 mt-1 text-right">10:29 AM</p>
                        </div>
                    </div>

                    <!-- Received Message -->
                    <div class="flex gap-3">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="User" class="w-8 h-8 rounded-full flex-shrink-0 mt-1">
                        <div class="flex-1">
                            <div class="bg-white border border-slate-200 rounded-lg px-4 py-2 inline-block max-w-xs">
                                <p class="text-slate-900">Perfect! I'll send you a calendar invite for Tuesday at 2 PM.</p>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">10:31 AM</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="p-4 border-t border-slate-200 bg-white">
                    <div class="flex gap-3">
                        <button class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-6 h-6 text-slate-400 hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                        <input 
                            type="text" 
                            placeholder="Type a message..." 
                            class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                        <button class="p-2 bg-gradient-primary text-white rounded-lg hover-glow transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
