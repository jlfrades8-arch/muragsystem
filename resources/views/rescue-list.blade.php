<!DOCTYPE html>
<html>
<head>
    <title>Reported Pets</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .pet-block { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; }
        button { padding: 8px 12px; margin-bottom: 15px; cursor: pointer; }
        .status-pending { color: red; font-weight: bold; }
        .status-rescued { color: green; font-weight: bold; }
    </style>
</head>
<body>

<h2>List of Reported Pets</h2>

<!-- Add Pet Button -->
<a href="{{ route('rescue.form') }}">
    <button type="button">+ Add a Pet</button>
</a>

@if($pets->isEmpty())
    <p>No pets have been reported yet.</p>
@else
    @foreach($pets as $index => $pet)
        <div class="pet-block">
            <h4>Pet #{{ $index + 1 }}</h4>
            <p><strong>Rescuer's Name:</strong> {{ $pet->full_name ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $pet->address }}</p>
            <p><strong>Location:</strong> {{ $pet->location }}</p>
            <p><strong>Condition:</strong> {{ $pet->condition }}</p>
            <p><strong>Kind:</strong> {{ $pet->kind }}</p>
            <p><strong>Color:</strong> {{ $pet->color ?? 'N/A' }}</p>
            <p><strong>Contact:</strong> {{ $pet->contact }}</p>

            <!-- ✅ Status display -->
                @php $status = $pet->status ?? 'Pending'; @endphp
                @if($status === 'Pending')
                    <p><strong>Status:</strong> <span class="status-pending">⏳ Pending Rescue</span></p>
                @elseif($status === 'not yet rescue')
                    <p><strong>Status:</strong> <span class="status-pending">not yet rescue</span></p>
                @elseif($status === 'Ready for Adoption')
                    <p><strong>Status:</strong> <span class="status-rescued">Ready for Adoption</span></p>
                @elseif($status === 'Adopted')
                    <p><strong>Status:</strong> <span class="status-rescued">Adopted</span></p>
                @else
                    <p><strong>Status:</strong> <span>{{ $status }}</span></p>
                @endif
                @if(session('role') === 'admin' && $status === 'not yet rescue')
                    <button style="background:#2b6cb0;color:#fff;border:none;padding:8px 10px;border-radius:6px;" onclick="markRescued({{ $pet->id }})">Set Ready for Adoption</button>
                @endif
        </div>
    @endforeach
@endif

        {{-- Admin action: mark as rescued --}}
        @if(session('role') === 'admin')
            <div style="margin-top:10px;">
                <form action="{{ route('rescue.markRescued', 0) }}" method="POST" id="markRescuedTemplate" style="display:none">
                    @csrf
                </form>
                <script>
                    function markRescued(id) {
                        if (!confirm('Mark this pet as rescued?')) return;
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/rescue/mark-rescued/' + id;
                        const token = document.createElement('input');
                        token.type = 'hidden';
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        form.appendChild(token);
                        document.body.appendChild(form);
                        form.submit();
                    }
                </script>
            </div>
        @endif

<a href="{{ route('login') }}">← Back to Login</a> 

</body>
</html>
