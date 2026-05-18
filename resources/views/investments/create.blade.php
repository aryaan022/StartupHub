@extends('layouts.main')

@section('title', 'Invest in ' . $startup->name . ' - StartupHub')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Hero Section -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <button onclick="history.back()" class="text-blue-600 hover:text-blue-700 font-medium text-sm mb-6">← Back</button>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-2xl font-bold">
                    {{ substr($startup->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Invest in {{ $startup->name }}</h1>
                    <p class="text-slate-600">{{ $startup->tagline }}</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-lg p-4">
                    <p class="text-xs text-slate-600 uppercase tracking-wide">Total Raised</p>
                    <p class="text-lg font-bold text-slate-900 mt-1">$12.5M</p>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <p class="text-xs text-slate-600 uppercase tracking-wide">Team Size</p>
                    <p class="text-lg font-bold text-slate-900 mt-1">42</p>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <p class="text-xs text-slate-600 uppercase tracking-wide">Founded</p>
                    <p class="text-lg font-bold text-slate-900 mt-1">2021</p>
                </div>
                <div class="bg-slate-50 rounded-lg p-4">
                    <p class="text-xs text-slate-600 uppercase tracking-wide">Growth</p>
                    <p class="text-lg font-bold text-emerald-600 mt-1">+245%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-slate-200 p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Investment Details</h2>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <p class="text-red-800 font-semibold mb-2">Please fix the following errors:</p>
                            <ul class="text-red-700 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('investments.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Hidden field for startup_id -->
                        <input type="hidden" name="startup_id" value="{{ $startup->id }}">

                        <!-- Investment Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-semibold text-slate-900 mb-2">
                                Investment Amount <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-600 font-semibold">$</span>
                                <input 
                                    type="number" 
                                    id="amount" 
                                    name="amount" 
                                    placeholder="50,000"
                                    step="1000"
                                    min="1000"
                                    max="10000000"
                                    value="{{ old('amount') }}"
                                    class="w-full pl-8 pr-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                            </div>
                            <p class="text-xs text-slate-600 mt-2">Minimum: $1,000 | Maximum: $10,000,000</p>
                            @error('amount')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Investment Type -->
                        <div>
                            <label for="investment_type" class="block text-sm font-semibold text-slate-900 mb-2">
                                Investment Type <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="investment_type" 
                                name="investment_type"
                                value="{{ old('investment_type') }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                                <option value="">Select investment type...</option>
                                <option value="seed" {{ old('investment_type') === 'seed' ? 'selected' : '' }}>Seed Round</option>
                                <option value="series_a" {{ old('investment_type') === 'series_a' ? 'selected' : '' }}>Series A</option>
                                <option value="series_b" {{ old('investment_type') === 'series_b' ? 'selected' : '' }}>Series B</option>
                                <option value="series_c" {{ old('investment_type') === 'series_c' ? 'selected' : '' }}>Series C</option>
                                <option value="venture" {{ old('investment_type') === 'venture' ? 'selected' : '' }}>Venture</option>
                                <option value="angel" {{ old('investment_type') === 'angel' ? 'selected' : '' }}>Angel</option>
                                <option value="strategic" {{ old('investment_type') === 'strategic' ? 'selected' : '' }}>Strategic</option>
                            </select>
                            @error('investment_type')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Equity Percentage -->
                        <div>
                            <label for="equity_percentage" class="block text-sm font-semibold text-slate-900 mb-2">
                                Equity Percentage <span class="text-slate-500">(Optional)</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="number" 
                                    id="equity_percentage" 
                                    name="equity_percentage"
                                    placeholder="5"
                                    step="0.1"
                                    min="0"
                                    max="100"
                                    value="{{ old('equity_percentage') }}"
                                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-600 font-semibold">%</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-2">Leave empty if no equity stake</p>
                            @error('equity_percentage')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-semibold text-slate-900 mb-2">
                                Investment Notes <span class="text-slate-500">(Optional)</span>
                            </label>
                            <textarea 
                                id="notes" 
                                name="notes"
                                placeholder="Any additional details or conditions..."
                                rows="4"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                            >{{ old('notes') }}</textarea>
                            <p class="text-xs text-slate-600 mt-2">Max 500 characters</p>
                            @error('notes')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Agreement -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-900">
                                <span class="font-semibold">Note:</span> By proceeding, you acknowledge that you have reviewed the startup's information and understand the risks associated with early-stage investments.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-6">
                            <button 
                                type="submit"
                                class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors"
                            >
                                Complete Investment
                            </button>
                            <button 
                                type="button"
                                onclick="history.back()"
                                class="flex-1 px-6 py-3 border-2 border-slate-300 text-slate-900 font-semibold rounded-lg hover:bg-slate-50 transition-colors"
                            >
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Investment Summary -->
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-4">Investment Summary</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-slate-600 uppercase tracking-wide">Company</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $startup->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 uppercase tracking-wide">Investor</p>
                            <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                        </div>
                        <hr class="border-slate-200">
                        <p class="text-xs text-slate-600">All investments are tracked in your portfolio and can be managed anytime.</p>
                    </div>
                </div>

                <!-- Investment Info -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                    <h3 class="font-semibold text-green-900 mb-4">Investment Benefits</h3>
                    <ul class="space-y-2 text-sm text-green-800">
                        <li class="flex gap-2">
                            <span class="text-green-600 font-bold">✓</span>
                            <span>Track all your investments in one place</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-600 font-bold">✓</span>
                            <span>Real-time portfolio updates</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-600 font-bold">✓</span>
                            <span>Access to investor network</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-600 font-bold">✓</span>
                            <span>Receive startup updates</span>
                        </li>
                    </ul>
                </div>

                <!-- Need Help -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-6">
                    <h3 class="font-semibold text-slate-900 mb-3">Need Help?</h3>
                    <p class="text-sm text-slate-600 mb-4">Check our investment guides and FAQs</p>
                    <a href="{{ route('resources.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                        View Resources →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
