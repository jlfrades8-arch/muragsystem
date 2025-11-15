<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Account Type - Pet Adoption System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Join Our Community</h1>
            <p class="text-gray-600 text-lg">Choose how you want to make a difference</p>
        </div>

        @php
            $adminRegistrationEnabled = \App\Models\Setting::get('admin_registration_enabled', '1') == '1';
        @endphp

        <!-- Cards Container -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- User Registration Card -->
            <a href="{{ route('register.user') }}" class="block group">
                <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-100 hover:border-purple-400 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl h-full">
                    <div class="flex flex-col items-center text-center h-full">
                        <!-- Icon -->
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Register as User</h2>
                        <p class="text-gray-600 mb-6 flex-grow">Adopt a pet, report rescues, and help animals find loving homes</p>

                        <!-- Features List -->
                        <ul class="text-left space-y-2 mb-6 w-full">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Browse available pets</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Submit adoption requests</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Report pets in need</span>
                            </li>
                        </ul>

                        <div class="inline-flex items-center text-blue-600 font-semibold group-hover:text-blue-700">
                            Continue as User
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Admin Registration Card -->
            @if($adminRegistrationEnabled)
            <a href="{{ route('register.admin') }}" class="block group">
                <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-100 hover:border-pink-400 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl h-full">
                    <div class="flex flex-col items-center text-center h-full">
                        <!-- Icon -->
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Register as Admin</h2>
                        <p class="text-gray-600 mb-6 flex-grow">Manage rescue operations, update pet statuses, and coordinate adoptions</p>

                        <!-- Features List -->
                        <ul class="text-left space-y-2 mb-6 w-full">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Manage rescue reports</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Update pet information</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Track adoption processes</span>
                            </li>
                        </ul>

                        <div class="inline-flex items-center text-pink-600 font-semibold group-hover:text-pink-700">
                            Continue as Admin
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            @else
            <!-- Admin Registration Disabled Card -->
            <div class="block">
                <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-300 opacity-60 h-full">
                    <div class="flex flex-col items-center text-center h-full">
                        <!-- Icon -->
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-500 mb-3">Admin Registration</h2>
                        <p class="text-gray-400 mb-6 flex-grow">Admin registration is currently disabled by system administrator</p>

                        <div class="inline-flex items-center text-gray-500 font-semibold px-4 py-2 bg-gray-100 rounded-lg cursor-not-allowed">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 2.697m8.268 11.882A6 6 0 1017.11 2.697M9 16a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Registration Disabled
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <p class="text-gray-600 mb-4">Already have an account?</p>
            <a href="{{ route('welcome') }}"
                class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Home
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>© 2025 Pet Adoption System. Making a difference together.</p>
        </div>
    </div>
</body>

</html>
