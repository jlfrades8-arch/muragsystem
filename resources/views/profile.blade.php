@extends('layouts.admin')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-subtitle', 'View and manage your account information')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 px-6 py-8">
            <div class="flex items-center space-x-4">
                @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover shadow-lg border-4 border-white">
                @else
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center font-bold text-2xl shadow-lg">
                    <span class="text-purple-600">{{ strtoupper(substr($user->email, 0, 1)) }}</span>
                </div>
                @endif
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $user->name ?? 'User' }}</h1>
                    <p class="text-purple-100">{{ $user->role === 'admin' ? 'Administrator' : 'Regular User' }}</p>
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="p-6 space-y-6">
            <!-- Profile Picture Upload -->
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-3">Profile Picture</label>
                <div class="flex flex-col sm:flex-row gap-6">
                    <div class="flex-shrink-0">
                        @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-xl object-cover shadow-lg border-2 border-gray-200">
                        @else
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <form id="profile-picture-form" action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            <div class="relative">
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="document.getElementById('profile-picture-form').submit()">
                                <label for="profile_picture" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold rounded-xl cursor-pointer transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ $user->profile_picture ? 'Change Photo' : 'Add Photo' }}
                                </label>
                            </div>
                            @if($user->profile_picture)
                            <button type="button" onclick="confirmDelete()" class="w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl border-2 border-red-200 transition-colors">
                                Remove Picture
                            </button>
                            <form id="delete-picture-form" action="{{ route('profile.delete-picture') }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200"></div>

            <!-- Full Name -->
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Full Name</label>
                <div class="px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl">
                    <p class="text-gray-900 font-medium">{{ $user->name ?? 'Not provided' }}</p>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Email Address</label>
                <div class="px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl">
                    <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Account Type</label>
                <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl">
                    <span class="inline-block px-3 py-1 {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }} rounded-full text-sm font-semibold">
                        {{ $user->role === 'admin' ? 'Administrator' : 'Regular User' }}
                    </span>
                </div>
            </div>

            <!-- Account Created -->
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Member Since</label>
                <div class="px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl">
                    <p class="text-gray-900 font-medium">{{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="mt-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-blue-800 font-medium text-sm">Profile Information</p>
                        <p class="text-blue-700 text-xs mt-1">Your profile information is displayed across the platform. For account security, please contact support to change your password or email address.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex gap-3">
            <a href="{{ route('dashboard') }}" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border-2 border-gray-300 hover:border-gray-400 transition-all shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to remove your profile picture?')) {
        document.getElementById('delete-picture-form').submit();
    }
}
</script>
@endsection
