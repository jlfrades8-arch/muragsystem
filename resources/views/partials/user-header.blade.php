<!-- User Header + Navigation (shared partial) -->
<div class="mb-6 flex flex-col items-center gap-4">
    <div class="w-full flex items-center justify-between bg-white rounded-2xl shadow-lg p-8">
        <div class="flex items-center space-x-6">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-md flex-shrink-0">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Welcome back!</h1>
                <p class="text-sm text-gray-500">Your pet adoption dashboard — quick links below</p>
            </div>
        </div>

        <nav class="flex items-center gap-2">
            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm">Dashboard</a>
            <a href="{{ route('adoption.list') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-emerald-600 hover:bg-emerald-50 shadow-sm">Browse Pets</a>
            <a href="{{ route('my.adoptions') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 shadow-sm">My Adoptions</a>
            <a href="{{ route('rescue.form') }}" class="px-4 py-2 rounded-full bg-gradient-to-r from-rose-500 to-pink-500 text-white text-sm font-bold shadow-md hover:opacity-95">Report Rescue</a>
            <a href="{{ route('rescue.list') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-full transition-all shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                View Reports
            </a>
        </nav>
    </div>
</div>
