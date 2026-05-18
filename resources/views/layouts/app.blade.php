<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="StartupHub - Premium startup ecosystem platform for founders, investors, and job seekers">
    <title>@yield('title', 'StartupHub - Startup Ecosystem Platform')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="bg-white text-gray-900">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white border-b border-gray-100 z-50 backdrop-blur-md bg-white/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 font-bold text-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">SH</span>
                    </div>
                    <span class="hidden sm:inline">StartupHub</span>
                </a>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('discover') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">Discover</a>
                    <a href="{{ route('jobs.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">Jobs</a>
                    <a href="{{ route('investors.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">Invest</a>
                    <a href="{{ route('resources.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">Resources</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="/dashboard" class="px-4 py-2 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition">
                            Dashboard
                        </a>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
                            Sign In
                        </a>
                        <a href="/register" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-bold mb-4">StartupHub</h3>
                    <p class="text-gray-400 text-sm">Premium startup ecosystem connecting founders, investors, and talent.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Platform</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('discover') }}" class="hover:text-white transition">Discover Startups</a></li>
                        <li><a href="{{ route('jobs.index') }}" class="hover:text-white transition">Find Jobs</a></li>
                        <li><a href="{{ route('investors.index') }}" class="hover:text-white transition">Invest</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">About</a></li>
                        <li><a href="{{ route('resources.index') }}" class="hover:text-white transition">Resources</a></li>
                        <li><a href="mailto:hello@startuphub.com" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><span class="cursor-not-allowed opacity-60">Privacy Policy</span></li>
                        <li><span class="cursor-not-allowed opacity-60">Terms of Service</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 StartupHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
