@extends('layouts.admin')

@section('title', 'User Profile')
@section('page-title', 'User Profile')
@section('page-subtitle', 'Details and adoptions for this user')

@section('content')
<div class="relative min-h-screen py-12 px-2 flex flex-col items-center justify-center">
  <!-- Decorative Background -->
  <div class="absolute inset-0 -z-10 pointer-events-none">
    <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-blue-400 via-cyan-400 to-purple-400 rounded-full filter blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-br from-purple-400 via-pink-400 to-blue-400 rounded-full filter blur-3xl opacity-20"></div>
  </div>

  <!-- Back Button -->
  <div class="max-w-xl w-full mx-auto mb-6">
    <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-lg shadow-md transition-all">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      Back to Users
    </a>
  </div>

  <!-- Profile Card -->
  <div class="max-w-2xl w-full mx-auto bg-white rounded-2xl shadow-2xl border border-gray-100 mb-8">
    <!-- Header with Profile Picture -->
    <div class="bg-gradient-to-r from-blue-500 via-cyan-500 to-purple-500 p-8 flex flex-col sm:flex-row items-center gap-6 rounded-t-2xl">
      @if($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-xl object-cover shadow-lg border-4 border-white">
      @else
        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-xl flex items-center justify-center shadow-lg border-4 border-white">
          <span class="text-4xl font-extrabold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
      @endif
      <div class="text-center sm:text-left flex-1">
        <h2 class="text-3xl font-extrabold text-white mb-1">{{ $user->name }}</h2>
        <p class="text-lg text-blue-100 mb-2">{{ $user->email }}</p>
        <span class="inline-block px-3 py-1 text-sm font-bold rounded-full bg-white bg-opacity-30 text-white shadow">Regular User</span>
      </div>
    </div>

    <!-- Profile Details -->
    <div class="p-8 space-y-6">
      <!-- ID and Joined Date Row -->
      <div class="grid grid-cols-2 gap-6">
        <div>
          <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">User ID</p>
          <p class="text-sm font-medium text-gray-900">#{{ $user->id }}</p>
        </div>
        <div>
          <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Joined</p>
          <p class="text-sm font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
        </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-200"></div>

      <!-- Contact Information -->
      <div>
        <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
          Contact Details
        </p>
        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
          @if($user->phone)
            <div class="flex items-start gap-3">
              <svg class="w-4 h-4 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wide">Phone</p>
                <p class="text-sm font-medium text-gray-900">{{ $user->phone }}</p>
              </div>
            </div>
          @endif
          @if($user->address)
            <div class="flex items-start gap-3">
              <svg class="w-4 h-4 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wide">Address</p>
                <p class="text-sm font-medium text-gray-900">{{ $user->address }}</p>
              </div>
            </div>
          @else
            <p class="text-sm text-gray-500 italic">No address provided</p>
          @endif
        </div>
      </div>

      <!-- Bio Section -->
      @if($user->bio)
      <div>
        <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          About
        </p>
        <p class="text-sm text-gray-700 bg-gray-50 rounded-lg p-4 leading-relaxed">{{ $user->bio }}</p>
      </div>
      @endif
    </div>
  </div>

  <!-- Adoptions List -->
  <div class="max-w-2xl w-full mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
    <h3 class="text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-600 to-purple-600 mb-6">Adoptions by this user</h3>
    @if($adoptions->count())
      <ul class="divide-y divide-gray-100">
        @foreach($adoptions as $adoption)
          <li class="py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
              <p class="font-semibold text-gray-800">Pet: {{ $adoption->pet_name ?? 'Unknown' }}</p>
              <p class="text-sm text-gray-500">Adopted: @if($adoption->adopted_at){{ is_string($adoption->adopted_at) ? $adoption->adopted_at : $adoption->adopted_at->format('M d, Y') }}@else Pending @endif</p>
            </div>
            <div class="mt-2 sm:mt-0">
              <span class="inline-block px-3 py-1 text-sm font-bold rounded-full shadow {{ $adoption->adopted_at ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ $adoption->adopted_at ? 'Adopted' : 'Pending' }}
              </span>
            </div>
          </li>
        @endforeach
      </ul>
    @else
      <p class="text-gray-500">No adoptions found for this user.</p>
    @endif
  </div>
</div>
@endsection
