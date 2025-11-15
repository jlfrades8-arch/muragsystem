@extends('layouts.admin')

@section('title', 'Feedbacks')
@section('page-title', 'Feedbacks')
@section('page-subtitle', 'User feedback and reports')

@section('content')
<div class="max-w-5xl mx-auto">
  <div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-bold mb-6">Feedbacks</h3>
    @if($feedbacks->count())
      <div class="space-y-4">
        @foreach($feedbacks as $fb)
          <div class="border border-gray-200 p-4 rounded-lg hover:shadow-md transition">
            <div class="flex justify-between items-start gap-4">
              <div class="flex-1">
                <p class="font-semibold text-gray-800">{{ $fb->name }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $fb->email ?? 'No email' }}</p>
                <div class="text-sm text-gray-700 mt-3 whitespace-pre-line">{{ $fb->message }}</div>
                <p class="text-xs text-gray-400 mt-2">{{ $fb->created_at->format('M d, Y H:i') }}</p>
              </div>
              <div class="flex flex-col gap-2">
                <span class="px-3 py-1 text-xs font-semibold rounded-full text-center {{ $fb->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                  {{ ucfirst($fb->status) }}
                </span>
                <a href="{{ route('admin.feedbacks.show', $fb->id) }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 text-center">
                  View & Reply
                </a>
                <!-- Review shortcut: opens the admin detail (same as View & Reply but labelled Review) -->
                <a href="{{ route('admin.feedbacks.show', $fb->id) }}" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded hover:bg-indigo-700 text-center">
                  Review
                </a>
                <!-- View public-facing feedback page as the user would see it -->
                <a href="{{ route('feedback.show', $fb->id) }}" target="_blank" rel="noopener" class="px-4 py-2 text-sm font-semibold text-purple-700 bg-purple-100 rounded hover:bg-purple-200 text-center">
                  View as User
                </a>
                @if($fb->status === 'open')
                  <form action="{{ route('admin.feedbacks.close', $fb->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded hover:bg-yellow-200">
                      Close
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500 text-center py-8">No feedback yet.</p>
    @endif
  </div>
</div>
@endsection
