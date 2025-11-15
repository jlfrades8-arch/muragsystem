@extends('layouts.admin')

@section('title', 'Users Management')
@section('page-title', 'Users Management')
@section('page-subtitle', 'View all registered users and their profiles')

@section('content')
<div class="space-y-6">
  <!-- Header -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="text-2xl font-bold text-gray-900">Regular Users</h2>
      <p class="text-gray-600 mt-1">Total users: <span class="font-semibold">{{ $users->count() }}</span></p>
    </div>
  </div>

  <!-- Users Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($users as $user)
      <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-200 overflow-hidden">
        <!-- Header with Role Badge -->
        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-4">
          <div class="flex items-start justify-between">
            <div>
              <h3 class="text-lg font-bold text-white">{{ $user->name }}</h3>
              <p class="text-sm text-blue-100 mt-1">{{ $user->email }}</p>
            </div>
            <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-200 text-blue-700">
              User
            </span>
          </div>
        </div>

        <!-- Profile Picture -->
        <div class="flex justify-center p-6 bg-gray-50 border-b border-gray-200">
          @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-lg object-cover shadow-md">
          @else
            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center shadow-md">
              <span class="text-4xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            </div>
          @endif
        </div>

        <!-- User Details -->
        <div class="p-6 space-y-4">
          <!-- ID -->
          <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">User ID</p>
            <p class="text-sm text-gray-900 font-medium mt-1">#{{ $user->id }}</p>
          </div>

          <!-- Role -->
          <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Role</p>
            <p class="text-sm text-gray-900 font-medium mt-1">
              <span class="inline-flex items-center space-x-1">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Regular User</span>
              </span>
            </p>
          </div>

          <!-- Joined Date -->
          <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Joined</p>
            <p class="text-sm text-gray-900 font-medium mt-1">{{ $user->created_at->format('M d, Y') }}</p>
          </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex gap-3">
          <a href="{{ route('admin.user.profile', $user->id) }}" class="flex-1 block px-4 py-2 text-sm font-semibold text-center rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">
            View Profile
          </a>
          <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full px-4 py-2 text-sm font-semibold text-center rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">
              Delete
            </button>
          </form>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
          <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048 4 4 0 010-8.048M12 14H8m4 0h4m-2-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <h3 class="text-lg font-semibold text-gray-900">No users found</h3>
          <p class="text-gray-500 mt-1">There are no registered regular users yet.</p>
        </div>
      </div>
    @endforelse
  </div>
</div>
@endsection
