<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code - Pet Adoption System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 mb-5 shadow-lg rounded-full overflow-hidden bg-transparent">
                <img src="{{ asset('images/logo/Pet.png') }}" alt="Pet Adoption Logo" class="w-full h-full object-cover block">
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Enter the 6-digit code</h1>
            <p class="text-gray-600">We sent a one-time code to your email to continue to change your password.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg overflow-x-auto">
                <div class="flex gap-2 items-start">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-green-800 font-medium break-all whitespace-normal max-w-full">{{ session('status') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg overflow-x-auto">
                <div class="flex gap-2 items-start">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-red-800 font-medium break-all whitespace-normal max-w-full">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            <form action="{{ route('dashboard.verify.post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">6-digit Code</label>
                    <input type="text" name="code" id="code" maxlength="6" required class="block w-full pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500" placeholder="Enter code">
                    @error('code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition duration-200 hover:scale-[1.02] shadow-lg">Verify Code</button>
            </form>

            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-800 break-words">
                    <strong>Tip:</strong> Check your email inbox or spam folder for the code. The code will expire in 24 hours.
                </p>
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-gray-500">
            <p>© 2025 Pet Adoption System. Saving lives, one paw at a time.</p>
        </div>
    </div>
</body>

</html>