@extends('layouts.admin')

@section('title', 'Adoption Management')
@section('page-title', 'Adoption Management')
@section('page-subtitle', 'Manage pet adoptions and availability')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($pets as $pet)
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all" id="pet-{{ $pet->id }}">

        <!-- Pet Photo Display -->
        @if($pet->image)
        <div class="relative group overflow-hidden">
            <img src="{{ asset('storage/' . $pet->image) }}"
                alt="{{ $pet->pet_name ?? 'Pet' }} photo"
                class="w-full h-64 object-cover transition-transform group-hover:scale-110 duration-300" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <p class="text-white text-lg font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $pet->pet_name ?? 'Unnamed Pet' }}
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-gradient-to-br from-gray-100 to-gray-200 h-64 flex items-center justify-center border-b-2 border-dashed border-gray-300">
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-500 text-sm font-medium">{{ $pet->pet_name ?? 'Unnamed Pet' }}</p>
                <p class="text-gray-400 text-xs mt-1">No photo available</p>
            </div>
        </div>
        @endif

        <!-- Pet Information -->
        <div class="p-6">
            <!-- Pet Name Header -->
            <div class="mb-4 pb-4 border-b-2 border-purple-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span id="pet-name-display-{{ $pet->id }}">{{ $pet->pet_name ?? 'Unnamed Pet' }}</span>
                    </h3>
                </div>
                <div class="flex items-center gap-2">
                    <input type="text" id="pet-name-input-{{ $pet->id }}" value="{{ $pet->pet_name ?? '' }}"
                        class="flex-1 px-3 py-2 border-2 border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                        placeholder="Enter pet name" />
                    <button type="button" class="save-pet-name-btn px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm font-bold rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all shadow-md hover:shadow-lg hover:scale-105" data-pet-id="{{ $pet->id }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Pet Details -->
            <div class="space-y-3 mb-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="text-xs text-gray-600 font-medium">Rescuer</p>
                        <p class="text-sm font-bold text-gray-900" id="name-display-{{ $pet->id }}">{{ $pet->full_name ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="text-xs text-gray-600 font-medium">Contact</p>
                        <p class="text-sm font-bold text-gray-900">{{ $pet->contact ?? 'No contact' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-purple-50 rounded-lg p-3 border border-purple-200">
                        <p class="text-xs text-purple-700 font-bold mb-1">Kind</p>
                        <p class="text-sm font-bold text-gray-900">{{ $pet->kind }}</p>
                    </div>
                    <div class="bg-pink-50 rounded-lg p-3 border border-pink-200">
                        <p class="text-xs text-pink-700 font-bold mb-1">Color</p>
                        <p class="text-sm font-bold text-gray-900">{{ $pet->color }}</p>
                    </div>
                </div>
            </div>

            <!-- Status Button -->
            <!-- Status Button -->
            @php
            // Define $st variable first
            $raw = $pet->status ?? 'not yet rescue';
            $st = ($raw === 'Rescued') ? 'Rescued' : $raw;

            // Then use it for statusColor
            $statusColor = $st === 'Ready for Adoption' ? 'from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-green-500/30 hover:shadow-green-500/50' : 'from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-red-500/30 hover:shadow-red-500/50';
            if ($st === 'Adopted') {
            $statusColor = 'from-purple-500 to-pink-500 opacity-60 cursor-not-allowed';
            }
            @endphp
            <button type="button" class="status-btn w-full px-4 py-3 bg-gradient-to-r {{ $statusColor }} text-white text-sm font-bold rounded-xl transition-all shadow-lg hover:scale-105 flex items-center justify-center" data-pet-id="{{ $pet->id }}" data-current-status="{{ $st }}" {{ $st === 'Adopted' ? 'disabled' : '' }}>
                @if($st === 'Ready for Adoption')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                @elseif($st === 'Adopted')
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                @else
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                @endif
                {{ $st }}
            </button>
        </div>
    </div>
    @empty
    <div class="col-span-full">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-16 text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-purple-100 via-pink-100 to-rose-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">No Pets Available for Adoption</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">There are currently no pets in the adoption management system. Rescued pets will appear here.</p>
            <a href="{{ route('admin.rescue.reports') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all shadow-lg hover:shadow-2xl hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                View Rescue Reports
            </a>
        </div>
    </div>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
    // Event delegation for status buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.status-btn')) {
            const btn = e.target.closest('.status-btn');
            const id = btn.dataset.petId;
            changeStatus(id, btn);
        }

        if (e.target.closest('.save-pet-name-btn')) {
            const btn = e.target.closest('.save-pet-name-btn');
            const id = btn.dataset.petId;
            savePetName(id);
        }
    });

    async function changeStatus(id, btn) {
        const current = btn.dataset.currentStatus || btn.innerText.trim();
        // allow changing from 'not yet rescue' or 'Rescued' to 'Ready for Adoption'
        if (current === 'not yet rescue' || current === 'Rescued') {
            if (!confirm('Change status to Ready for Adoption?')) return;
            const token = '{{ csrf_token() }}';
            try {
                const res = await fetch('/admin/rescue/' + id + '/status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: 'Ready for Adoption'
                    })
                });
                const data = await res.json();
                if (data.success) {
                    const statusText = data.status || 'Ready for Adoption';

                    // Update button classes and content
                    btn.className = 'status-btn w-full mt-2 px-4 py-3 text-white text-sm font-bold rounded-lg transition-all';

                    if (statusText === 'not yet rescue' || statusText === 'Rescued') {
                        btn.className += ' bg-red-500 hover:bg-red-600';
                        btn.innerHTML = `
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    ${statusText}
                                </span>
                            `;
                        btn.disabled = false;
                    } else if (statusText === 'Ready for Adoption') {
                        btn.className += ' bg-green-500 hover:bg-green-600';
                        btn.innerHTML = `
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    ${statusText}
                                </span>
                            `;
                        btn.disabled = false;
                    } else if (statusText === 'Adopted') {
                        btn.className += ' bg-purple-500 opacity-50 cursor-not-allowed';
                        btn.innerHTML = `<span class="flex items-center justify-center">${statusText}</span>`;
                        btn.disabled = true;
                    }

                    showNotification('Status updated successfully!', 'success');
                } else {
                    showNotification(data.message || 'Update failed', 'error');
                }
            } catch (e) {
                console.error(e);
                showNotification('Network error occurred', 'error');
            }
        } else {
            showNotification('This status cannot be changed from this view', 'error');
        }
    }
</script>
<script>
    async function savePetName(id) {
        const input = document.getElementById('pet-name-input-' + id);
        if (!input) return;
        const value = input.value.trim();
        if (!value) {
            showNotification('Pet name cannot be empty', 'error');
            return;
        }
        if (!confirm('Save this pet name?')) return;

        const token = document.querySelector('meta[name="csrf-token"]').content;
        try {
            const res = await fetch('/admin/rescue/' + id + '/update-pet-name', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    pet_name: value
                })
            });
            const data = await res.json();
            if (res.ok && data.success) {
                document.getElementById('pet-name-display-' + id).innerText = data.pet_name;
                showNotification('Pet name updated successfully!', 'success');
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
        notification.className = `fixed top-4 right-4 p-4 border-l-4 rounded-r-lg shadow-lg z-50 ${colors[type]} animate-fade-in`;
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