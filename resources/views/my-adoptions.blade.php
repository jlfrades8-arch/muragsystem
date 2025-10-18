@extends('layouts.admin')

@section('title', 'My Adoptions')
@section('page-title', 'My Adopted Pets')
@section('page-subtitle', 'View and manage your adopted companions')

@section('content')
<!-- Stats Card -->
<div class="mb-8">
    <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6 inline-flex items-center space-x-4">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Total Adoptions</p>
            <p class="text-4xl font-black text-transparent bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text">
                {{ count($adoptions ?? []) }}
            </p>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-lg animate-pulse">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-green-800 font-bold">{{ session('success') }}</p>
    </div>
</div>
@endif

<!-- Adopted Pets List -->
@forelse($adoptions as $adoption)
@php $pet = $adoption->rescue; @endphp
<div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-2 border-gray-100 hover:border-green-300 mb-6 hover:-translate-y-1">
    <div class="md:flex">
        <!-- Pet Image -->
        <div class="md:w-80 h-64 md:h-auto bg-gradient-to-br from-green-200 via-emerald-200 to-teal-200 flex-shrink-0 relative overflow-hidden">
            @if(!empty($pet->image_url))
            <img src="{{ $pet->image_url }}" alt="{{ $pet->pet_name ?? 'Pet' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
            @elseif(!empty($pet->image))
            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->pet_name ?? 'Pet' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
            @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-24 h-24 text-white opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>
            @endif
            <div class="absolute top-4 left-4">
                <span class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Adopted
                </span>
            </div>
        </div>

        <!-- Pet Details -->
        <div class="flex-1 p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">
                        {{ $pet->pet_name ?? ($pet->full_name ? 'Pet of ' . $pet->full_name : 'Unnamed Pet') }}
                    </h2>
                    <p class="text-sm text-gray-500 font-medium mb-2">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            Rescued by: <span class="font-bold text-gray-700 ml-1">{{ $pet->full_name ?? 'Unknown' }}</span>
                        </span>
                    </p>
                    <div class="flex items-center space-x-2 text-sm text-green-700 bg-green-50 px-3 py-1.5 rounded-lg inline-flex">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">Adopted on: {{ optional($adoption->adopted_at)->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Pet Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="flex items-center space-x-3 p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Species</p>
                        <p class="text-lg text-gray-900 font-black">{{ $pet->kind }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Color</p>
                        <p class="text-lg text-gray-900 font-black">{{ $pet->color }}</p>
                    </div>
                </div>

                @if(!empty($pet->age))
                <div class="flex items-center space-x-3 p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Age</p>
                        <p class="text-lg text-gray-900 font-black">{{ $pet->age }} years</p>
                    </div>
                </div>
                @endif

                @if(!empty($pet->condition))
                <div class="flex items-center space-x-3 p-4 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Condition</p>
                        <p class="text-lg text-gray-900 font-black">{{ $pet->condition }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Adoption Details -->
            <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm font-bold text-gray-700">Adoption Information</p>
                </div>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-500 font-medium">Adopted by:</p>
                        <p class="text-gray-900 font-bold">{{ $adoption->adopter_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 font-medium">Adopter Email:</p>
                        <p class="text-gray-900 font-bold">{{ $adoption->adopter_email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<!-- Empty State -->
<div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-16 text-center">
    <div class="w-24 h-24 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
        </svg>
    </div>
    <h3 class="text-2xl font-bold text-gray-700 mb-2">No Adoptions Yet</h3>
    <p class="text-gray-600 mb-6">You haven't adopted any pets yet. Browse available pets to find your perfect companion!</p>
    <a href="{{ route('adoption') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
        Browse Available Pets
    </a>
</div>
@endforelse
@endsection