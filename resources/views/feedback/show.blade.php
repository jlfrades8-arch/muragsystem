@extends('layouts.admin')

@section('title', 'My Feedback')
@section('page-title', 'My Feedback')
@section('page-subtitle', 'View your submitted feedback and any replies')

@section('content')
<div class="max-w-3xl mx-auto">
  <div class="bg-white p-6 rounded-lg shadow mb-6">
    <div class="flex justify-between items-start mb-4">
      <div>
        <h3 class="text-lg font-bold">{{ $feedback->name }}</h3>
        <p class="text-sm text-gray-600">{{ $feedback->email }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $feedback->created_at->format('M d, Y H:i') }}</p>
      </div>
      <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $feedback->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
        {{ ucfirst($feedback->status) }}
      </span>
    </div>
    <div class="bg-gray-50 p-4 rounded border-l-4 border-blue-500">
      <p class="text-gray-800">{{ $feedback->message }}</p>
    </div>
  </div>

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

  <div class="text-center">
    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-700">Back to Dashboard</a>
  </div>
</div>
@endsection
