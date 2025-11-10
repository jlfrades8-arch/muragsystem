@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Your pet adoption journey starts here')
@section('hide-sidebar', true)

@section('content')
<!-- Main Content -->

@include('partials.user-header')

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Available Pets -->
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-100 p-6 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-600 mb-1">Available Pets</p>
                <p class="text-4xl font-black text-transparent bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text">
                    {{ isset($pets) ? $pets->count() : 0 }}
                </p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center text-xs text-purple-600 font-medium">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            Ready for adoption
        </div>
    </div>

    <!-- My Adoptions -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-md transition-all duration-300 border border-gray-100 p-6 transform hover:-translate-y-0.5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-600 mb-1">My Adoptions</p>
                <p class="text-4xl font-extrabold text-gray-900">{{ $adoptionsCount ?? 0 }}</p>
            </div>
            <div class="w-16 h-16 bg-clip-padding rounded-xl flex items-center justify-center shadow-inner" style="background:linear-gradient(135deg,#34d399,#10b981);">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center text-xs text-green-600 font-medium">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
            </svg>
            Your adopted pets
        </div>
    </div>

    <!-- Total Rescued -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-md transition-all duration-300 border border-gray-100 p-6 transform hover:-translate-y-0.5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-600 mb-1">Total Rescued</p>
                <p class="text-4xl font-extrabold text-gray-900">
                    {{ isset($pets) ? $pets->count() : 0 }}
                </p>
            </div>
            <div class="w-16 h-16 bg-clip-padding rounded-xl flex items-center justify-center shadow-inner" style="background:linear-gradient(135deg,#60a5fa,#7c3aed);">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center text-xs text-blue-600 font-medium">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            Community impact
        </div>
    </div>
</div>

@include('partials.adoption-hero')

<div class="p-8">
        @if(isset($pets) && $pets->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pets as $pet)
            <div class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 hover:shadow-lg transition-all duration-300 border-2 border-gray-200 hover:border-purple-300">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-bold text-gray-900 mb-1">{{ $pet->pet_name ?? ($pet->full_name ?? 'Unknown') }}</h3>
                        <p class="text-xs text-gray-600 mb-1">{{ $pet->kind }} • {{ $pet->color }}</p>
                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                            Ready
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('adoption.list') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
                View All Available Pets
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-700 mb-2">No Pets Available</h3>
            <p class="text-gray-600 mb-6">Check back soon for new pets available for adoption</p>
        </div>
        @endif
    </div>
</div>
</div>
@endsection