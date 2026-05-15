<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center text-white font-bold text-lg group-hover:shadow-lg transition-all">
                    S
                </div>
                <span class="font-bold text-lg text-slate-900 hidden sm:inline">StartupHub</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('discover') }}" class="text-slate-600 hover:text-slate-900 font-medium transition-colors">
                    Discover
                </a>
                <a href="{{ route('jobs.index') }}" class="text-slate-600 hover:text-slate-900 font-medium transition-colors">
                    Jobs
                </a>
                <a href="{{ route('investors.index') }}" class="text-slate-600 hover:text-slate-900 font-medium transition-colors">
                    Invest
                </a>
                <a href="#" class="text-slate-600 hover:text-slate-900 font-medium transition-colors">
                    Resources
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
                @auth
                    <!-- User Menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-100 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline text-sm font-medium">{{ auth()->user()->first_name }}</span>
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 py-2">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                Dashboard
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                Profile Settings
                            </a>
                            <a href="{{ route('messages.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                Messages
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    Admin Panel
                                </a>
                            @endif
                            <hr class="my-2 border-slate-200">
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <a href="{{ route('notifications.index') }}" class="relative p-2 rounded-lg hover:bg-slate-100 transition-colors">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900 font-medium transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:inline px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Get Started
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="p-2 rounded-lg hover:bg-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Mobile Navigation -->
                <div x-show="open" @click.outside="open = false" class="absolute top-16 left-0 right-0 bg-white border-b border-slate-200 py-4 px-4 shadow-lg">
                    <a href="{{ route('discover') }}" class="block px-4 py-2 text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg">Discover</a>
                    <a href="{{ route('jobs.index') }}" class="block px-4 py-2 text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg">Jobs</a>
                    <a href="{{ route('investors.index') }}" class="block px-4 py-2 text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg">Invest</a>
                    <a href="#" class="block px-4 py-2 text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg">Resources</a>
                    @guest
                        <a href="{{ route('register') }}" class="block px-4 py-2 mt-4 bg-blue-600 text-white rounded-lg font-medium text-center hover:bg-blue-700">
                            Get Started
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
