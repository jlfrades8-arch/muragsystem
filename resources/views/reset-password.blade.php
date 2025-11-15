<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Pet Adoption System</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <!-- Logo/Header -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-20 h-20 mb-4 shadow-lg">
        <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
        </div>
      </div>
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Reset Password</h1>
      <p class="text-gray-600">Enter your new password below</p>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
      <!-- Alert Messages -->
      @if(session('error'))
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
        <div class="flex items-center">
          <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
          <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
      </div>
      @endif

      @if($errors->any())
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
        <div class="flex items-start">
          <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
          <div>
            <p class="text-red-800 font-medium mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-red-700 text-sm">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      @endif

      <!-- Form -->
      <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <!-- Email Display -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
          <div class="px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl">
            <p class="text-gray-700 font-medium">{{ $email }}</p>
          </div>
        </div>

        <!-- New Password -->
        <div>
          <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
          <input type="password" id="password" name="password" required
            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-colors"
            placeholder="Enter new password (minimum 6 characters)">
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required
            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-colors"
            placeholder="Confirm your new password">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-3 px-4 rounded-xl transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          Reset Password
        </button>
      </form>

      <!-- Additional Links -->
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          Remember your password?
          <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-700 hover:underline">
            Login here
          </a>
        </p>
      </div>
    </div>

    <!-- Security Note -->
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
      <div class="flex items-start">
        <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
        </svg>
        <div>
          <p class="text-blue-800 font-medium text-sm">Security Tip</p>
          <p class="text-blue-700 text-xs mt-1">Choose a strong password with at least 6 characters. Consider using a mix of letters, numbers, and symbols.</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>