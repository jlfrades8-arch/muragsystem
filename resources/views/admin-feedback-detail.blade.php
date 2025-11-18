@extends('layouts.admin')

@section('title', 'Feedback Detail')
@section('page-title', 'Feedback Detail')
@section('page-subtitle', 'View and reply to feedback')

@section('content')
<div class="max-w-3xl mx-auto">
  <!-- Original Feedback -->
  <div class="bg-white p-6 rounded-lg shadow mb-6">
    <div class="flex justify-between items-start mb-4">
      <div>
        <h3 class="text-lg font-bold">{{ $feedback->name }}</h3>
        <p class="text-sm text-gray-600">{{ $feedback->email }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $feedback->created_at->format('M d, Y H:i') }}</p>
      </div>
        <div class="flex flex-col items-end space-y-2">
          <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $feedback->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
            {{ ucfirst($feedback->status) }}
          </span>

          <div class="flex items-center gap-2">
            <a href="{{ route('admin.feedbacks') }}" class="inline-flex items-center px-3 py-1.5 bg-white text-gray-700 border border-gray-200 rounded hover:bg-gray-50 text-sm font-medium">
              Back
            </a>
          </div>
        </div>
    </div>
    <div class="bg-gray-50 p-4 rounded border-l-4 border-blue-500">
      <p class="text-gray-800">{{ $feedback->message }}</p>
    </div>
  </div>

  <!-- Replies -->
  @if($replies->count())
  <div class="bg-white p-6 rounded-lg shadow mb-6">
    <h4 class="font-bold mb-4">Replies</h4>
    <div class="space-y-4">
      @foreach($replies as $reply)
      <div class="bg-blue-50 p-4 rounded border-l-4 border-indigo-600">
        <p class="text-sm font-semibold text-indigo-700">{{ $reply->admin?->name ?? 'Admin' }}</p>
        <p class="text-xs text-gray-500 mt-1">{{ $reply->created_at->format('M d, Y H:i') }}</p>
        <p class="text-gray-800 mt-2">{{ $reply->message }}</p>
      </div>
      @endforeach
    </div>
  </div>
  @endif

  <!-- Reply Form -->
  @if($feedback->status === 'open' && $feedback->user_id !== session('user_id') && $feedback->email !== session('user_email'))
  <div class="bg-white p-6 rounded-lg shadow">
    <h4 class="font-bold mb-4">Send Reply</h4>
    <form action="{{ route('admin.feedbacks.reply', $feedback->id) }}" method="POST">
      @csrf
      <div class="mb-4">
        <label class="text-xs font-semibold">Your Reply</label>
        <textarea name="message" rows="4" class="w-full mt-1 p-2 border rounded" required>{{ old('message') }}</textarea>
        @error('message')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex items-center gap-3">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Send Reply</button>
        <a href="{{ route('admin.feedbacks') }}" class="text-sm text-gray-500 hover:text-gray-700">Back</a>
      </div>
    </form>
  </div>
  @elseif($feedback->user_id === session('user_id') || $feedback->email === session('user_email'))
  <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
    <p class="text-blue-800"><strong>Note:</strong> This is your own feedback. You cannot reply to your own feedback as an admin.</p>
    <a href="{{ route('admin.feedbacks') }}" class="text-blue-600 hover:text-blue-700 text-sm mt-3 inline-block">← Back to Feedbacks</a>
  </div>
  @else
  <div class="text-center py-8">
    <p class="text-gray-600">This feedback is closed. No more replies can be added.</p>
    <a href="{{ route('admin.feedbacks') }}" class="text-indigo-600 hover:text-indigo-700 text-sm mt-2 inline-block">Back to Feedbacks</a>
  </div>
  @endif
</div>
@endsection
