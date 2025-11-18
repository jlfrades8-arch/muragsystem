<!-- User Header + Navigation (shared partial) -->
<div class="mb-6 flex flex-col items-center gap-4">
    <div class="w-full bg-white rounded-2xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-6">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-md flex-shrink-0">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900">Welcome back!</h1>
                    <p class="text-sm text-gray-500">Your pet adoption dashboard — quick links below</p>
                </div>
            </div>
        </div>

        <!-- Quick Navigation Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 pt-6 border-t border-gray-100">
            <!-- Browse Pets -->
            <a href="{{ route('adoption.list') }}" class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-4 text-center group hover:shadow-md transition-all duration-300 border border-emerald-100 hover:border-emerald-300">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-emerald-600 transition-colors">Browse Pets</h3>
                <p class="text-xs text-gray-500 mt-1">Available pets</p>
            </a>

            <!-- My Adoptions -->
            <a href="{{ route('my.adoptions') }}" class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-4 text-center group hover:shadow-md transition-all duration-300 border border-purple-100 hover:border-purple-300">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-purple-600 transition-colors">My Adoptions</h3>
                <p class="text-xs text-gray-500 mt-1">Your pets</p>
            </a>

            <!-- Report Rescue -->
            <a href="{{ route('rescue.form') }}" class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 text-center group hover:shadow-md transition-all duration-300 border border-green-100 hover:border-green-300">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-green-600 transition-colors">Report Rescue</h3>
                <p class="text-xs text-gray-500 mt-1">Found a pet?</p>
            </a>

            <!-- View Reports -->
            <a href="{{ route('rescue.list') }}" class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 text-center group hover:shadow-md transition-all duration-300 border border-blue-100 hover:border-blue-300">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-blue-600 transition-colors">View Reports</h3>
                <p class="text-xs text-gray-500 mt-1">Rescue list</p>
            </a>

            <!-- Community Feedback -->
            <a href="{{ route('feedback.index') }}" class="bg-gradient-to-br from-cyan-50 to-sky-50 rounded-xl p-4 text-center group hover:shadow-md transition-all duration-300 border border-cyan-100 hover:border-cyan-300">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-sky-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-cyan-600 transition-colors">Community</h3>
                <p class="text-xs text-gray-500 mt-1">All feedback</p>
            </a>

            <!-- My Feedback -->
            <a href="{{ route('feedback.index') }}" class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 text-center group hover:shadow-md transition-all duration-300 border border-amber-100 hover:border-amber-300">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-amber-600 transition-colors">My Feedback</h3>
                <p class="text-xs text-gray-500 mt-1">Your messages</p>
            </a>
        </div>
    </div>
</div>