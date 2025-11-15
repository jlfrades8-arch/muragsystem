@extends('layouts.admin')

@section('title', 'Feedback')
@section('page-title', 'Send Feedback')
@section('page-subtitle', 'Let us know how we can improve')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-bold mb-4">Send Feedback</h3>

    @php
      $userName = session('user_email') ? \App\Models\User::where('email', session('user_email'))->first()?->name : null;
    @endphp

    <form action="{{ route('feedback.store') }}" method="POST">
      @csrf
      
      @if($userName)
        <!-- Logged-in user: show name, hide email input -->
        <div class="mb-3">
          <label class="text-xs font-semibold">Your Name</label>
          <input type="text" class="w-full mt-1 p-2 border rounded bg-gray-100" value="{{ $userName }}" disabled>
        </div>
      @else
        <!-- Guest: show optional fields -->
        <div class="mb-3">
          <label class="text-xs font-semibold">Name (optional)</label>
          <input type="text" name="name" class="w-full mt-1 p-2 border rounded" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
          <label class="text-xs font-semibold">Email (optional)</label>
          <input type="email" name="email" class="w-full mt-1 p-2 border rounded" value="{{ old('email') }}">
        </div>
      @endif
      
      <div class="mb-4">
        <label class="text-xs font-semibold">Message</label>
        <textarea name="message" rows="6" class="w-full mt-1 p-2 border rounded" required>{{ old('message') }}</textarea>
      </div>
      <div class="flex items-center gap-3">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Send</button>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
