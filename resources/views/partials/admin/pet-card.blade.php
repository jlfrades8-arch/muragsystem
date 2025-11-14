<div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all" id="pet-{{ $pet->id }}">

    <!-- Pet Photo Display -->
    @if($pet->image)
    <div class="relative group overflow-hidden">
        <img src="{{ asset('storage/' . $pet->image) }}"
            alt="{{ $pet->pet_name ?? 'Pet' }} photo"
            class="w-full h-64 object-cover transition-transform group-hover:scale-110 duration-300 pet-image-{{ $pet->id }}" />
        <label class="absolute top-3 right-3 inline-block m-0 p-0 z-30">
            <input type="file" accept="image/*" class="upload-input-admin absolute inset-0 w-full h-full opacity-0 cursor-pointer z-40" data-pet-id="{{ $pet->id }}">
            <button type="button" class="change-photo-btn bg-white/90 text-xs px-3 py-1 rounded-lg shadow-sm hover:bg-white transform transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 flex items-center gap-2 relative z-30" data-pet-id="{{ $pet->id }}">
                <svg class="w-3.5 h-3.5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h4l3-3h4l3 3h4v11a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v6"></path></svg>
                <span class="text-xs font-semibold">Change</span>
            </button>
        </label>
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-10">
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
            <div class="mt-3">
                <label class="relative inline-block z-20">
                    <input type="file" accept="image/*" class="upload-input-admin absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30" data-pet-id="{{ $pet->id }}">
                    <button type="button" class="change-photo-btn inline-flex items-center px-3 py-1.5 bg-white border border-gray-200 rounded text-sm font-semibold hover:bg-gray-50 relative z-20" data-pet-id="{{ $pet->id }}">Add Photo</button>
                </label>
            </div>
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
        @php
            $raw = $pet->status ?? 'not yet rescue';
            $st = ($raw === 'Rescued') ? 'Rescued' : $raw;
            $hasPendingAdoption = $pet->adoptions->filter(fn($a) => $a->adopted_at === null)->count() > 0;
            if ($st === 'Ready for Adoption') {
                if ($hasPendingAdoption) {
                    $st = 'Pending for Adoption';
                    $statusColor = 'from-yellow-400 to-amber-500 hover:from-yellow-500 hover:to-amber-600 shadow-yellow-400/30 hover:shadow-yellow-400/50 text-yellow-900';
                    $disabled = false;
                } else {
                    $statusColor = 'from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-green-500/30 hover:shadow-green-500/50 text-white';
                    $disabled = false;
                }
            } elseif ($st === 'Adopted') {
                $statusColor = 'from-purple-500 to-pink-500 opacity-60 cursor-not-allowed text-white';
                $disabled = true;
            } elseif (strtolower($st) === 'not yet rescue') {
                $statusColor = 'from-gray-300 to-gray-400 text-gray-700 opacity-80 cursor-not-allowed';
                $disabled = true;
            } else {
                $statusColor = 'from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-red-500/30 hover:shadow-red-500/50 text-white';
                $disabled = false;
            }
        @endphp

        <button type="button" class="status-btn w-full px-4 py-3 bg-gradient-to-r {{ $statusColor }} text-sm font-bold rounded-xl transition-all shadow-lg hover:scale-105 flex items-center justify-center" data-pet-id="{{ $pet->id }}" data-current-status="{{ $st }}" data-has-pending="{{ $hasPendingAdoption ? '1' : '0' }}" {{ $disabled ? 'disabled' : '' }}>
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

        @if($hasPendingAdoption)
        <div class="mt-3 flex gap-2">
            <button type="button" class="cancel-adoption-btn flex-1 px-3 py-2 bg-red-50 border border-red-200 text-red-700 text-sm font-semibold rounded-lg hover:bg-red-100 transition-all" data-pet-id="{{ $pet->id }}">
                <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                Cancel Adoption
            </button>
        </div>
        @endif
    </div>
</div>