@extends('layouts.admin')

@section('title', 'Adopt Pet')
@section('page-title', 'Adopt a Pet')
@section('page-subtitle', 'Complete the form to adopt this lovely companion')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('adoption.list') }}" class="inline-flex items-center px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border-2 border-gray-200 transition-all shadow-sm hover:shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Adoption List
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <!-- Left Column - Pet Photo and Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden sticky top-24">
                <!-- Pet Photo -->
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
                    </div>
                </div>
                @endif

                <!-- Pet Details -->
                <div class="p-6">
                    <div class="mb-6">
                        @php
                        $statusLabel = $pet->status ?? 'Pending';
                        @endphp
                        @if(isset($hasPendingAdoption) && $hasPendingAdoption)
                        <div class="inline-flex items-center px-4 py-2 bg-yellow-400 text-yellow-900 rounded-xl shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                            </svg>
                            <span class="font-bold text-sm">Pending for Adoption</span>
                        </div>
                        @else
                        <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl shadow-lg">
                            <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white font-bold text-sm">{{ $statusLabel }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Pet Name</label>
                            <div class="p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-200">
                                <p class="text-gray-900 font-bold flex items-center">
                                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    {{ $pet->pet_name ?? 'Unnamed' }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Type</label>
                                <div class="p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 text-center">
                                    <p class="text-gray-900 font-bold">{{ $pet->kind }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Color</label>
                                <div class="p-3 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl border border-pink-200 text-center">
                                    <p class="text-gray-900 font-bold">{{ $pet->color }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Rescuer</label>
                            <div class="p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                <p class="text-gray-900 font-medium flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $pet->full_name ?? 'Unknown' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Adoption Form -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Adoption Request Form
                    </h3>
                    <p class="text-purple-100 text-sm mt-1">Please provide your information to adopt this pet</p>
                </div>

                <form action="{{ route('adoption.submit') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <input type="hidden" name="pet_id" value="{{ $pet->id }}">

                    <!-- Info Alert -->
                    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-blue-800 font-medium text-sm">Important Information</p>
                                <p class="text-blue-700 text-xs mt-1">By submitting this form, you agree to provide a loving home and proper care for this pet.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Your Name -->
                        <div>
                            <label for="adopter_name" class="block text-sm font-bold text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Your Full Name
                                    <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <input
                                type="text"
                                id="adopter_name"
                                name="adopter_name"
                                value="{{ old('adopter_name', session('user_name', '')) }}"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all text-gray-900 font-medium"
                                placeholder="Enter your full name">
                            @error('adopter_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact" class="block text-sm font-bold text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Contact Number
                                    <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <input
                                type="text"
                                id="contact"
                                name="contact"
                                value="{{ old('contact') }}"
                                required
                                pattern="^(09|\+639)\d{9}$"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all text-gray-900 font-medium"
                                placeholder="e.g., 09171234567 or +639171234567">
                            <p class="mt-1 text-xs text-gray-500">Philippine mobile number format</p>
                            @error('contact')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (auto-filled from session) -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Your Email
                                </span>
                            </label>
                            <div class="px-4 py-3 bg-gray-100 border-2 border-gray-300 rounded-xl text-gray-700 font-medium">
                                {{ session('user_email', 'Not logged in') }}
                            </div>
                            <p class="mt-1 text-xs text-gray-500">This email is from your logged-in account</p>
                        </div>

                        <!-- Photo/Image Upload -->
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex gap-4">
                        @if(isset($hasPendingAdoption) && $hasPendingAdoption)
                        <div class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-yellow-400 text-yellow-900 font-bold rounded-xl transition-all shadow-lg text-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                            </svg>
                            Pending — Someone has requested adoption
                        </div>
                        <a href="{{ route('adoption.list') }}" class="px-6 py-4 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border-2 border-gray-300 hover:border-gray-400 transition-all shadow-sm hover:shadow-md inline-flex items-center justify-center">Back to list</a>
                        @else
                        <button
                            type="submit"
                            class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            Submit Adoption Request
                        </button>
                        <a
                            href="{{ route('adoption.list') }}"
                            class="px-6 py-4 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border-2 border-gray-300 hover:border-gray-400 transition-all shadow-sm hover:shadow-md inline-flex items-center justify-center">
                            Cancel
                        </a>
                        @endif
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-6 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-200">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-purple-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            <div>
                                <p class="text-purple-900 font-bold text-sm">What happens next?</p>
                                <ul class="mt-2 space-y-1 text-purple-800 text-xs">
                                    <li class="flex items-start">
                                        <span class="mr-2">•</span>
                                        <span>Your adoption request will be reviewed by our team</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2">•</span>
                                        <span>We'll contact you via email or phone for the next steps</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2">•</span>
                                        <span>You can track your adoption in "My Adoptions" section</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const photoUploadArea = document.getElementById('photo-upload-area');
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');
    const previewImg = document.getElementById('preview-img');

    // Click to upload
    photoUploadArea.addEventListener('click', () => photoInput.click());

    // Drag and drop
    photoUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        photoUploadArea.classList.add('border-purple-500', 'bg-purple-50');
    });

    photoUploadArea.addEventListener('dragleave', () => {
        photoUploadArea.classList.remove('border-purple-500', 'bg-purple-50');
    });

    photoUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        photoUploadArea.classList.remove('border-purple-500', 'bg-purple-50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            photoInput.files = files;
            updatePhotoPreview(photoInput);
        }
    });

    function updatePhotoPreview(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                photoPreview.classList.remove('hidden');
                photoUploadArea.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearPhotoUpload() {
        photoInput.value = '';
        photoPreview.classList.add('hidden');
        photoUploadArea.classList.remove('hidden');
    }
</script>
@endsection