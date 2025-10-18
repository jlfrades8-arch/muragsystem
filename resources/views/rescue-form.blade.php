<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pet Rescue Form - Report a Pet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 min-h-screen">

    <!-- Header -->
    <div class="bg-white shadow-lg border-b border-purple-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Pet Rescue Form</h1>
                        <p class="text-sm text-gray-600">Help us rescue a pet in need</p>
                    </div>
                </div>
                <a href="{{ route('rescue.list') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View Reports
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-r-xl p-4 shadow-lg animate-fade-in">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-red-800 mb-2">Please correct the following errors:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-700">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 p-6 text-white">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Report Pet Details</h2>
                        <p class="text-purple-100 text-sm">Fill in the information about the pet you found</p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <form action="{{ route('rescue.submit') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf

                @php
                $startIndex = $nextIndex ?? 0;
                @endphp

                <div class="space-y-6">
                    <!-- Rescuer Information Section -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Your Information
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label for="full_name" class="block text-sm font-bold text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="full_name" name="pets[{{ $startIndex }}][full_name]" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 font-medium"
                                    placeholder="Enter your full name">
                            </div>

                            <div>
                                <label for="contact" class="block text-sm font-bold text-gray-700 mb-2">
                                    Contact Number <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <input type="tel" id="contact" name="pets[{{ $startIndex }}][contact]" required
                                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 font-medium"
                                        placeholder="e.g., 09123456789">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pet Location Section -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border-2 border-green-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pet Location
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label for="address" class="block text-sm font-bold text-gray-700 mb-2">
                                    Address <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="address" name="pets[{{ $startIndex }}][address]" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-gray-900 font-medium"
                                    placeholder="Street address where you saw the pet">
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-bold text-gray-700 mb-2">
                                    Location Description <span class="text-red-500">*</span>
                                </label>
                                <textarea id="location" name="pets[{{ $startIndex }}][location]" required rows="3"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-gray-900 font-medium resize-none"
                                    placeholder="Describe the exact location (e.g., near the park, beside the store)"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Pet Details Section -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border-2 border-purple-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            Pet Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Pet Name Field -->
                            <div class="md:col-span-2">
                                <label for="pet_name" class="block text-sm font-bold text-gray-700 mb-2">
                                    Pet Name (Optional)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="pet_name" name="pets[{{ $startIndex }}][pet_name]"
                                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900 font-medium"
                                        placeholder="e.g., Blackie, Fluffy, Max (if known)">
                                </div>
                                <p class="mt-1 text-xs text-gray-600">
                                    <svg class="w-3 h-3 inline text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    If you know the pet's name or want to give it a name
                                </p>
                            </div>

                            <div>
                                <label for="kind" class="block text-sm font-bold text-gray-700 mb-2">
                                    Type of Pet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="kind" name="pets[{{ $startIndex }}][kind]" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900 font-medium"
                                    placeholder="e.g., Dog, Cat, Bird">
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-bold text-gray-700 mb-2">
                                    Color <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="color" name="pets[{{ $startIndex }}][color]" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900 font-medium"
                                    placeholder="e.g., Brown, Black and White">
                            </div>

                            <div class="md:col-span-2">
                                <label for="condition" class="block text-sm font-bold text-gray-700 mb-2">
                                    Condition <span class="text-red-500">*</span>
                                </label>
                                <textarea id="condition" name="pets[{{ $startIndex }}][condition]" required rows="3"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900 font-medium resize-none"
                                    placeholder="Describe the pet's condition (e.g., injured, healthy, scared, hungry)"></textarea>
                            </div>

                            <!-- Pet Photo Upload -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-bold text-gray-700 mb-2">
                                    Pet Photo (Optional)
                                </label>
                                <div class="relative">
                                    <input type="file" id="image" name="pets[{{ $startIndex }}][image]" accept="image/*"
                                        class="hidden"
                                        onchange="previewImage(event)">
                                    <label for="image" class="cursor-pointer">
                                        <div id="upload-area" class="border-2 border-dashed border-purple-300 rounded-xl p-6 text-center hover:border-purple-500 hover:bg-purple-50 transition-all">
                                            <div id="preview-container" class="hidden">
                                                <img id="image-preview" class="mx-auto rounded-lg shadow-lg max-h-64 mb-3" alt="Preview">
                                                <p class="text-sm text-purple-600 font-semibold">Click to change photo</p>
                                            </div>
                                            <div id="upload-prompt">
                                                <svg class="w-12 h-12 text-purple-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <p class="text-sm text-gray-600 font-medium mb-1">
                                                    <span class="text-purple-600 font-bold">Click to upload</span> or drag and drop
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                                            </div>
                                        </div>
                                    </label>
                                    <p class="mt-2 text-xs text-gray-600">
                                        <svg class="w-4 h-4 inline text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        Adding a photo helps us identify and rescue the pet faster
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="pets[{{ $startIndex }}][status]" value="Pending">
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex items-center justify-between border-t-2 border-gray-200 pt-6">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Login
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-2xl hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Submit Rescue Report
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Info -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl p-4">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h4 class="text-sm font-bold text-blue-900 mb-1">Need Help?</h4>
                    <p class="text-sm text-blue-800">Please provide as much detail as possible to help us locate and rescue the pet quickly. All fields marked with <span class="text-red-500 font-bold">*</span> are required.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-prompt').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>