@extends('layouts.admin')

@section('title', 'My Feedbacks')
@section('page-title', 'My Feedbacks')
@section('page-subtitle', 'Your submitted feedback and replies')

@section('content')
<div class="max-w-4xl mx-auto">
  <div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-lg font-bold">My Feedbacks</h3>
      <div class="flex gap-2">
        <a href="{{ route('feedback.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">
          Community Feedbacks
        </a>
        <a href="{{ route('feedback.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm font-medium">
          Submit Feedback
        </a>
      </div>
    </div>

    @if($feedbacks->count())
    <div class="space-y-6">
      @foreach($feedbacks as $fb)
      <div class="border border-gray-200 p-4 rounded-lg">
        <div class="flex justify-between items-start">
          <div class="flex-1">
            <p class="font-semibold text-gray-800">{{ $fb->name ?? 'Guest' }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $fb->email ?? 'No email' }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $fb->created_at->format('M d, Y H:i') }}</p>

            <div class="mt-3 text-sm text-gray-700 whitespace-pre-line">
              {{ $fb->message }}
            </div>

            @if($fb->replies && $fb->replies->count())
            <div class="mt-4 bg-gray-50 p-3 rounded border-l-4 border-indigo-200">
              <h4 class="font-semibold text-sm text-indigo-700 mb-2">Replies</h4>
              @foreach($fb->replies as $reply)
              <div class="mb-3 last:mb-0">
                <p class="text-sm font-semibold text-indigo-700">{{ $reply->admin?->name ?? 'Admin' }}</p>
                <p class="text-xs text-gray-500">{{ $reply->created_at->format('M d, Y H:i') }}</p>
                <p class="text-gray-800 mt-1 text-sm">{{ $reply->message }}</p>
              </div>
              @endforeach
            </div>
            @endif

          </div>
          <div class="ml-4 text-right">
            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $fb->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
              {{ ucfirst($fb->status) }}
            </span>
            <div class="mt-3">
              <a href="{{ route('feedback.show', $fb->id) }}" class="inline-block px-3 py-1 text-sm bg-purple-100 text-purple-700 rounded hover:bg-purple-200">View</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <p class="text-gray-500 text-center py-8">You haven't submitted any feedback yet. <a href="{{ route('feedback.create') }}" class="text-purple-600 hover:underline">Submit your first feedback</a>!</p>
    @endif
  </div>
</div>
@endsection