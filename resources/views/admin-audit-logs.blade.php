@extends('layouts.admin')

@section('title', 'Audit Logs')
@section('page-title', 'Audit Logs')
@section('page-subtitle', 'Actions performed by admins (deletions, etc.)')

@section('content')
<div class="max-w-6xl mx-auto">
  <div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-bold mb-4">Audit Logs</h3>
    @if($logs->count())
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
          <thead>
            <tr class="text-left text-sm text-gray-500">
              <th class="px-4 py-2">When</th>
              <th class="px-4 py-2">Actor</th>
              <th class="px-4 py-2">Action</th>
              <th class="px-4 py-2">Target</th>
              <th class="px-4 py-2">Meta</th>
            </tr>
          </thead>
          <tbody class="text-sm text-gray-700">
            @foreach($logs as $log)
              <tr class="border-t">
                <td class="px-4 py-3">{{ $log->created_at->format('M d, Y H:i') }}</td>
                <td class="px-4 py-3">{{ $log->actor_name ?? 'System' }}<br><span class="text-xs text-gray-400">{{ $log->actor_email }}</span></td>
                <td class="px-4 py-3"><span class="font-semibold">{{ $log->action }}</span></td>
                <td class="px-4 py-3">{{ $log->target_user_name ?? '-' }}<br><span class="text-xs text-gray-400">{{ $log->target_user_email }}</span></td>
                <td class="px-4 py-3"><pre class="text-xs text-gray-500">{{ json_encode($log->meta) }}</pre></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="text-gray-500">No audit events recorded yet.</p>
    @endif
  </div>
</div>
@endsection
