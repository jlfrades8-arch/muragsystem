@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of all reported pets')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Reports Card -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-indigo-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-blue-100 hover:border-blue-300 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-indigo-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Total</span>
            </div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Total Reports</p>
            <p class="text-4xl font-black text-gray-900 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">{{ $pets->count() }}</p>
            <div class="mt-3 flex items-center text-xs text-blue-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                </svg>
                All reports tracked
            </div>
        </div>
    </div>

    <!-- Pending Card -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-red-50 via-white to-rose-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-red-100 hover:border-red-300 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-400/20 to-rose-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/30 group-hover:scale-110 transition-transform duration-300 animate-pulse">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Urgent</span>
            </div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Pending</p>
            <p class="text-4xl font-black text-gray-900 bg-gradient-to-r from-red-600 to-rose-600 bg-clip-text text-transparent">{{ $pets->whereIn('status', ['Pending', 'not yet rescue', 'Pending for Adoption'])->count() }}</p>
            <div class="mt-3 flex items-center text-xs text-red-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Needs attention
            </div>
        </div>
    </div>

    <!-- Rescued Card -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-emerald-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-green-100 hover:border-green-300 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/20 to-emerald-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Safe</span>
            </div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Rescued</p>
            <p class="text-4xl font-black text-gray-900 bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">{{ $pets->whereIn('status', ['Rescued', 'Ready for Adoption'])->count() }}</p>
            <div class="mt-3 flex items-center text-xs text-green-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Successfully rescued
            </div>
        </div>
    </div>

    <!-- Adopted Card -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-purple-50 via-white to-pink-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-100 hover:border-purple-300 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">Forever Home</span>
            </div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Adopted</p>
            <p class="text-4xl font-black text-gray-900 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $pets->where('status', 'Adopted')->count() }}</p>
            <div class="mt-3 flex items-center text-xs text-purple-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                </svg>
                Happy endings
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Table -->
<div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <span class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </span>
                    All Rescue Reports
                </h3>
                <p class="text-sm text-gray-600 mt-2 ml-13">Manage rescue statuses and view details</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-4 py-2 bg-white rounded-lg shadow-sm text-sm font-semibold text-gray-700 border border-gray-200">
                    {{ isset($pets) ? $pets->count() : 0 }} Reports
                </span>
            </div>
        </div>
    </div>

    @if(isset($pets) && $pets->count())
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 table-fixed">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Reporter</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Condition</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kind</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Color</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-44">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pets as $i => $pet)
                <tr class="hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-purple-50/30 transition-all duration-200 group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-br from-blue-100 to-purple-100 text-blue-700 rounded-lg font-bold text-sm mr-3">{{ $i + 1 }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $pet->full_name ?? data_get($pet, 'full_name') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $pet->address ?? data_get($pet, 'address') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pet->location ?? data_get($pet, 'location') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">{{ $pet->condition ?? data_get($pet, 'condition') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $pet->kind ?? data_get($pet, 'kind') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pet->color ?? data_get($pet, 'color') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pet->contact ?? data_get($pet, 'contact') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if(!empty($pet->image) || data_get($pet, 'image'))
                        <img src="{{ Storage::url($pet->image ?? data_get($pet, 'image')) }}" alt="pet photo" class="w-20 h-14 object-cover rounded-lg shadow-sm" />
                        @else
                        <div class="w-20 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">No image</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap w-44">
                        @php
                            $status = $pet->status ?? data_get($pet, 'status', 'Pending');
                            $hasPending = isset($pendingAdoptionsByRescueId[$pet->id]) && count($pendingAdoptionsByRescueId[$pet->id]) > 0;
                            $displayStatus = $hasPending ? 'Pending for Adoption' : $status;
                        @endphp

                        <span class="px-4 py-2 inline-flex items-center text-xs font-bold rounded-xl shadow-sm
                                        {{ $displayStatus === 'Adopted' ? 'bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800' : '' }}
                                        {{ in_array($displayStatus, ['Rescued', 'Ready for Adoption']) ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800' : '' }}
                                        {{ in_array($displayStatus, ['Pending for Adoption', 'Pending', 'not yet rescue']) ? 'bg-gradient-to-r from-red-100 to-rose-100 text-red-800' : '' }}
                                        {{ $displayStatus === 'In Progress' ? 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800' : '' }}">
                            @if($displayStatus === 'Adopted')
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            @elseif(in_array($displayStatus, ['Rescued', 'Ready for Adoption']))
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @elseif(in_array($displayStatus, ['Pending for Adoption', 'Pending', 'not yet rescue']))
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                            {{ $displayStatus }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-16 text-center bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Reports Found</h3>
        <p class="text-gray-600 mb-6">There are no rescue reports yet</p>
        <a href="{{ route('rescue.form') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create New Report
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Event delegation for mark as rescued buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.mark-rescued-btn')) {
            const btn = e.target.closest('.mark-rescued-btn');
            const id = btn.dataset.petId;
            markAsRescued(id, btn);
        }
    });

    async function markAsRescued(id, btn) {
        if (!confirm('Mark this pet as rescued?')) return;

        const token = document.querySelector('meta[name="csrf-token"]').content;
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Updating...';

        try {
            const res = await fetch('/admin/rescue/' + id + '/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: 'Rescued'
                })
            });

            const data = await res.json();

            if (data.success) {
                const statusText = data.status || 'Pending';

                // Update button styling based on new status
                btn.className = 'px-4 py-2 text-white text-xs font-semibold rounded-lg transition-colors';

                if (statusText === 'Pending' || statusText === 'not yet rescue') {
                    btn.className += ' bg-red-500 hover:bg-red-600';
                    btn.innerText = 'Pending Response';
                    btn.disabled = false;
                } else if (statusText === 'Ready for Adoption' || statusText === 'Rescued') {
                    btn.className += ' bg-green-500 hover:bg-green-600';
                    btn.innerText = 'Rescued';
                    btn.disabled = (statusText === 'Rescued');
                } else if (statusText === 'Adopted') {
                    btn.className += ' bg-purple-500 opacity-75 cursor-not-allowed';
                    btn.innerText = 'Adopted';
                    btn.disabled = true;
                } else {
                    btn.innerText = statusText;
                    btn.disabled = false;
                }

                // Show success message
                showNotification('Status updated successfully!', 'success');
            } else {
                btn.innerText = originalText;
                btn.disabled = false;
                showNotification(data.message || 'Update failed', 'error');
            }
        } catch (e) {
            console.error(e);
            btn.innerText = originalText;
            btn.disabled = false;
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

    // Upload image flow: open file picker and POST to server
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.upload-image-btn');
        if (!btn) return;
        const id = btn.dataset.petId;
        const input = document.querySelector('.upload-input[data-pet-id="' + id + '"]');
        if (input) input.click();
    });

    document.addEventListener('change', async function(e) {
        const input = e.target.closest('.upload-input');
        if (!input) return;
        const id = input.dataset.petId;
        if (!input.files || !input.files[0]) return;

        if (!confirm('Upload this image as the pet picture?')) {
            input.value = null;
            return;
        }

        const file = input.files[0];
        const token = document.querySelector('meta[name="csrf-token"]').content;

        const formData = new FormData();
        formData.append('image', file);

        try {
            const res = await fetch('/admin/rescue/' + id + '/upload-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            });

            const data = await res.json();
            if (data.success) {
                // Update the thumbnail if present, otherwise replace the SVG
                const preview = document.querySelector('.image-preview-' + id);
                if (preview) {
                    preview.src = data.image;
                } else {
                    const container = document.querySelector('.upload-input[data-pet-id="' + id + '"]').closest('td').querySelector('div.w-14');
                    if (container) {
                        container.innerHTML = '<img src="' + data.image + '" alt="pet" class="w-full h-full object-cover image-preview-' + id + '">';
                    }
                }
                showNotification('Image uploaded', 'success');
            } else {
                showNotification(data.message || 'Upload failed', 'error');
            }
        } catch (err) {
            console.error(err);
            showNotification('Network error during upload', 'error');
        } finally {
            input.value = null;
        }
    });
</script>
@endpush