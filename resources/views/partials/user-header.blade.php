<!-- User Header + Navigation (shared partial) -->
<div class="mb-6 flex flex-col items-center gap-4">
    <div class="flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-md">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">Welcome back!</h1>
            <p class="text-sm text-gray-500">Your pet adoption dashboard — quick links below</p>
        </div>
    </div>

    <nav class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm">Dashboard</a>
        <a href="{{ route('adoption.list') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-teal-600 hover:bg-teal-50 shadow-sm">Browse Pets</a>
        <a href="{{ route('my.adoptions') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 shadow-sm">My Adoptions</a>
        <a href="{{ route('rescue.form') }}" class="px-4 py-2 rounded-full bg-gradient-to-r from-rose-500 to-pink-500 text-white text-sm font-bold shadow-md hover:opacity-95">Report Rescue</a>
    </nav>
</div>
