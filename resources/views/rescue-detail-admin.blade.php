@extends('layouts.admin')

@section('title', 'Rescue Details')
@section('page-title', 'Rescue Details')
@section('page-subtitle', 'Detailed information about the rescue report')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.rescue.reports') }}" class="inline-flex items-center px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border-2 border-gray-200 transition-all shadow-sm hover:shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Reports
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Pet Photo and Basic Info -->
        <div class="lg:col-span-1">
            <!-- Pet Photo Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-6">
                @if($pet->image)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $pet->image) }}"
                        alt="{{ $pet->pet_name ?? 'Pet' }} photo"
                        class="w-full h-80 object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h2 class="text-2xl font-bold text-white mb-1 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                {{ $pet->pet_name ?? 'Unnamed Pet' }}
                            </h2>
                            <p class="text-purple-200 text-sm">{{ $pet->kind }} • {{ $pet->color }}</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-gradient-to-br from-purple-100 via-pink-100 to-rose-100 h-80 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-24 h-24 mx-auto text-purple-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-700 mb-2">{{ $pet->pet_name ?? 'Unnamed Pet' }}</h2>
                        <p class="text-purple-600 font-medium">{{ $pet->kind }} • {{ $pet->color }}</p>
                        <p class="text-gray-500 text-sm mt-2">No photo available</p>
                    </div>
                </div>
                @endif

                <!-- Status Badge -->
                <div class="p-6">
                    @php
                    $raw = $pet->status ?? 'not yet rescue';
                    $st = ($raw === 'Rescued') ? 'Rescued' : $raw;

                    if ($st === 'Ready for Adoption') {
                    $statusColor = 'from-green-500 to-emerald-600';
                    $statusIcon = 'M5 13l4 4L19 7';
                    } elseif ($st === 'Adopted') {
                    $statusColor = 'from-purple-500 to-pink-500';
                    $statusIcon = 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z';
                    } else {
                    $statusColor = 'from-red-500 to-rose-600';
                    $statusIcon = 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z';
                    }
                    @endphp
                    <div class="bg-gradient-to-r {{ $statusColor }} rounded-xl p-4 text-center">
                        <p class="text-white/80 text-xs font-bold uppercase tracking-wider mb-1">Current Status</p>
                        <div class="flex items-center justify-center text-white">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusIcon }}"></path>
                            </svg>
                            <span class="text-xl font-bold">{{ $st }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Info Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-lg border-2 border-blue-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Quick Info
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Type</span>
                        <span class="text-sm font-bold text-gray-900">{{ $pet->kind }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Color</span>
                        <span class="text-sm font-bold text-gray-900">{{ $pet->color }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Report ID</span>
                        <span class="text-sm font-bold text-gray-900">#{{ $pet->id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Detailed Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Rescuer Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Rescuer Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Full Name</label>
                            <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-gray-900 font-bold">{{ $pet->full_name }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Contact Number</label>
                            <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-gray-900 font-bold">{{ $pet->contact }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pet Location -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pet Location
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Address</label>
                            <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                <p class="text-gray-900 font-medium flex items-start">
                                    <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    {{ $pet->address }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Location Description</label>
                            <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                <p class="text-gray-900 font-medium">{{ $pet->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pet Details -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        Pet Details & Condition
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Pet Name</label>
                            <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-200">
                                <p class="text-gray-900 font-bold text-lg flex items-center">
                                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    {{ $pet->pet_name ?? 'Unnamed' }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Type & Color</label>
                            <div class="flex gap-2">
                                <div class="flex-1 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-200 text-center">
                                    <p class="text-xs text-purple-700 font-bold mb-1">Type</p>
                                    <p class="text-gray-900 font-bold">{{ $pet->kind }}</p>
                                </div>
                                <div class="flex-1 p-4 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl border border-pink-200 text-center">
                                    <p class="text-xs text-pink-700 font-bold mb-1">Color</p>
                                    <p class="text-gray-900 font-bold">{{ $pet->color }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Condition Report</label>
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-200">
                            <p class="text-gray-900 font-medium leading-relaxed">{{ $pet->condition }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <div class="flex flex-wrap gap-4">
                    @if($pet->status !== 'Adopted' && $pet->status !== 'Ready for Adoption')
                    <button onclick="markAsRescued({{ $pet->id }})" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Mark as Ready for Adoption
                    </button>
                    @elseif($pet->status === 'Ready for Adoption')
                    <div class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold rounded-xl shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Available for Adoption
                    </div>
                    @endif
                    <a href="{{ route('admin.rescue.reports') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        View All Reports
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    async function markAsRescued(id) {
        if (!confirm('Mark this pet as ready for adoption? It will be visible to users for adoption.')) return;

        try {
            const res = await fetch(`/rescue/mark-rescued/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            const data = await res.json();
            if (data.success) {
                showNotification('Pet is now ready for adoption!', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showNotification(data.message || 'Update failed', 'error');
            }
        } catch (e) {
            console.error(e);
            showNotification('Network error occurred', 'error');
        }
    }

    function showNotification(message, type) {
        const colors = {
            success: 'bg-green-50 border-green-500 text-green-800',
            error: 'bg-red-50 border-red-500 text-red-800'
        };

        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 border-l-4 rounded-r-lg shadow-lg z-50 ${colors[type]}`;
        notification.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="font-medium">${message}</p>
            </div>
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
@endpush
@endsection