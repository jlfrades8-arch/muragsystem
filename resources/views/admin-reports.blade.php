@extends('layouts.admin')

@section('title', 'Rescue Reports')
@section('page-title', 'Rescue Reports')
@section('page-subtitle', 'View and manage all rescue reports')

@section('content')
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
        <table class="min-w-full divide-y divide-gray-200">
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
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pets as $i => $pet)
                <tr class="hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-purple-50/30 transition-all duration-200 group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-br from-blue-100 to-purple-100 text-blue-700 rounded-lg font-bold text-sm group-hover:scale-110 transition-transform">
                            {{ $i + 1 }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-semibold text-gray-900">{{ $pet->full_name ?? data_get($pet, 'full_name') }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $pet->address ?? data_get($pet, 'address') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pet->location ?? data_get($pet, 'location') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">{{ $pet->condition ?? data_get($pet, 'condition') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $pet->kind ?? data_get($pet, 'kind') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pet->color ?? data_get($pet, 'color') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pet->contact ?? data_get($pet, 'contact') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php $status = $pet->status ?? data_get($pet, 'status', 'Pending'); @endphp
                        <span class="px-4 py-2 inline-flex items-center text-xs font-bold rounded-xl shadow-sm
                                        {{ $status === 'Adopted' ? 'bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800' : '' }}
                                        {{ in_array($status, ['Rescued', 'Ready for Adoption']) ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800' : '' }}
                                        {{ in_array($status, ['Pending', 'not yet rescue']) ? 'bg-gradient-to-r from-red-100 to-rose-100 text-red-800' : '' }}
                                        {{ $status === 'In Progress' ? 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800' : '' }}">
                            @if($status === 'Adopted')
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            @elseif(in_array($status, ['Rescued', 'Ready for Adoption']))
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @elseif(in_array($status, ['Pending', 'not yet rescue']))
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                            {{ $status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('rescue.show', ['id' => $pet->id ?? $i]) }}"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-xs font-bold rounded-xl transition-all shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>
                            <form action="{{ route('rescue.updateStatus', ['id' => $pet->id ?? $i]) }}" method="POST" class="inline-flex items-center space-x-2">
                                @csrf
                                <select name="status" class="text-xs font-medium border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 bg-white shadow-sm">
                                    <option value="Pending" {{ ($status == 'Pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ ($status == 'In Progress') ? 'selected' : '' }}>In Progress</option>
                                    <option value="Resolved" {{ ($status == 'Resolved') ? 'selected' : '' }}>Resolved</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs font-bold rounded-xl transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-105">
                                    Update
                                </button>
                            </form>
                        </div>
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