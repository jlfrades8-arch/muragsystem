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
  <div class="max-w-xl w-full mx-auto bg-white rounded-2xl shadow-2xl border border-gray-100 p-10 flex flex-col items-center mb-8">
    @if($user->profile_picture)
      <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-36 h-36 rounded-2xl object-cover shadow-lg border-4 border-white mb-4">
    @else
      <div class="w-36 h-36 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg border-4 border-white mb-4">
        <span class="text-6xl font-extrabold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
      </div>
    @endif
    <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-600 to-purple-600 mb-1">{{ $user->name }}</h2>
    <p class="text-lg text-gray-600 mb-2">{{ $user->email }}</p>
    <span class="px-4 py-1 text-sm font-bold rounded-full bg-gradient-to-r from-blue-200 to-cyan-200 text-blue-700 mb-2 shadow">Regular User</span>
    <p class="text-base text-gray-500">Joined: <span class="font-semibold">{{ is_string($user->created_at) ? $user->created_at : $user->created_at->format('M d, Y') }}</span></p>
  </div>

  <!-- Adoptions List -->
  <div class="max-w-xl w-full mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
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
