<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reported Pets - Rescue List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">

    <!-- Header -->
    <div class="bg-white shadow-lg border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Reported Pets</h1>
                        <p class="text-sm text-gray-600">View all rescue reports</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 font-bold text-sm rounded-xl border border-blue-200">
                        {{ $pets->count() }} {{ $pets->count() === 1 ? 'Pet' : 'Pets' }} Reported
                    </span>
                    <a href="{{ route('rescue.form') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Pet Report
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if($pets->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-16 text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">No Pets Reported Yet</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">Be the first to report a pet in need of rescue. Your report can save a life!</p>
            <a href="{{ route('rescue.form') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all shadow-lg hover:shadow-2xl hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Report a Pet
            </a>
        </div>
        @else
        <!-- Pet Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($pets as $index => $pet)
            @php $status = $pet->status ?? 'Pending'; @endphp
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl border border-gray-200 overflow-hidden transition-all duration-300 hover:-translate-y-2">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <span class="text-white font-black text-lg">{{ $index + 1 }}</span>
                            </div>
                            <div class="text-white">
                                <p class="text-sm font-semibold opacity-90">Pet Report</p>
                                <p class="text-xs opacity-75">{{ $pet->created_at ? $pet->created_at->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <!-- Status Badge -->
                        @if($status === 'Pending' || $status === 'not yet rescue')
                        <span class="px-3 py-1.5 bg-red-500/90 text-white rounded-full text-xs font-bold shadow-lg animate-pulse">
                            <span class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pending
                            </span>
                        </span>
                        @elseif($status === 'Ready for Adoption')
                        <span class="px-3 py-1.5 bg-green-500/90 text-white rounded-full text-xs font-bold shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Ready
                            </span>
                        </span>
                        @elseif($status === 'Adopted')
                        <span class="px-3 py-1.5 bg-purple-500/90 text-white rounded-full text-xs font-bold shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                Adopted
                            </span>
                        </span>
                        @else
                        <span class="px-3 py-1.5 bg-gray-500/90 text-white rounded-full text-xs font-bold shadow-lg">
                            {{ $status }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <!-- Rescuer Info -->
                    <div class="mb-4 pb-4 border-b-2 border-gray-100">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Reported By</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $pet->full_name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-xs text-gray-600 ml-13">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ $pet->contact }}
                        </div>
                    </div>

                    <!-- Pet Details -->
                    <div class="space-y-3 mb-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-gray-500">Pet Type & Color</p>
                                <p class="text-sm font-bold text-gray-900">{{ $pet->kind }} • {{ $pet->color ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-gray-500">Location</p>
                                <p class="text-sm font-medium text-gray-900">{{ $pet->address }}</p>
                                <p class="text-xs text-gray-600 mt-0.5">{{ $pet->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-gray-500">Condition</p>
                                <p class="text-sm text-gray-900">{{ $pet->condition }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Action -->
                    @if(session('role') === 'admin' && ($status === 'not yet rescue' || $status === 'Pending'))
                    <button onclick="markRescued({{ $pet->id }})" class="w-full mt-4 px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Mark as Ready for Adoption
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Footer Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-center">
            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl transition-all shadow-md hover:shadow-lg border border-gray-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Login
            </a>
        </div>
    </div>

    {{-- Admin action: mark as rescued --}}
    @if(session('role') === 'admin')
    <script>
        function markRescued(id) {
            if (!confirm('Mark this pet as ready for adoption?')) return;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/rescue/mark-rescued/' + id;

            const token = document.createElement('input');
            token.type = 'hidden';
            token.name = '_token';
            token.value = '{{ csrf_token() }}';
            form.appendChild(token);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
    @endif

</body>

</html>