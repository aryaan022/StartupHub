<footer class="bg-slate-900 text-slate-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
            <!-- Brand -->
            <div class="col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                        S
                    </div>
                    <span class="font-bold text-lg text-white">StartupHub</span>
                </div>
                <p class="text-sm text-slate-400 mb-4">
                    Connecting startups, investors, and talent in one premium ecosystem.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20v-7.21H5.5V9.98h2.79V7.97c0-2.69 1.64-4.16 4.04-4.16 1.15 0 2.14.08 2.43.12v2.82h-1.67c-1.31 0-1.56.62-1.56 1.53v2h3.11l-.405 2.81h-2.705V20"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                </div>
            </div>

            <!-- Platform Links -->
            <div>
                <h4 class="font-semibold text-white mb-4">Platform</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('discover') }}" class="text-sm hover:text-white transition-colors">Discover Startups</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="text-sm hover:text-white transition-colors">Find Jobs</a></li>
                    <li><a href="{{ route('investors.index') }}" class="text-sm hover:text-white transition-colors">Explore Investors</a></li>
                    <li><span class="text-sm text-slate-500 cursor-not-allowed">About Us</span></li>
                </ul>
            </div>

            <!-- For Users -->
            <div>
                <h4 class="font-semibold text-white mb-4">For Users</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('register', ['role' => 'founder']) }}" class="text-sm hover:text-white transition-colors">For Startups</a></li>
                    <li><a href="{{ route('register', ['role' => 'investor']) }}" class="text-sm hover:text-white transition-colors">For Investors</a></li>
                    <li><a href="{{ route('register', ['role' => 'job_seeker']) }}" class="text-sm hover:text-white transition-colors">For Job Seekers</a></li>
                    <li><span class="text-sm text-slate-500 cursor-not-allowed">For Partners</span></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="font-semibold text-white mb-4">Resources</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('resources.index') }}" class="text-sm hover:text-white transition-colors">Guides & Tutorials</a></li>
                    <li><a href="{{ route('resources.index') }}#faqs" class="text-sm hover:text-white transition-colors">FAQs</a></li>
                    <li><a href="{{ route('discover') }}" class="text-sm hover:text-white transition-colors">Discover Startups</a></li>
                    <li><a href="{{ route('investors.index') }}" class="text-sm hover:text-white transition-colors">Find Investors</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h4 class="font-semibold text-white mb-4">Legal</h4>
                <ul class="space-y-2">
                    <li><span class="text-sm text-slate-500 cursor-not-allowed">Privacy Policy</span></li>
                    <li><span class="text-sm text-slate-500 cursor-not-allowed">Terms of Service</span></li>
                    <li><span class="text-sm text-slate-500 cursor-not-allowed">Security</span></li>
                    <li><a href="mailto:hello@startuphub.com" class="text-sm hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-slate-800 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-slate-400">&copy; {{ date('Y') }} StartupHub. All rights reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <span class="text-sm text-slate-500 cursor-not-allowed">Privacy</span>
                    <span class="text-sm text-slate-500 cursor-not-allowed">Terms</span>
                    <span class="text-sm text-slate-500 cursor-not-allowed">Cookies</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating CTA -->
    <div class="fixed bottom-8 right-8 hidden lg:block">
        <a href="{{ route('register') }}" class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-full font-medium shadow-lg hover:bg-blue-700 transition-colors">
            <span>Get Started</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>
</footer>
