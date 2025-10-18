<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; }
        .nav { display: flex; gap: 12px; align-items: center; }
        .nav a, .nav form { display: inline; }
        .nav a, .nav button { text-decoration: none; padding: 8px 12px; background: #2b6cb0; color: #fff; border: none; border-radius: 6px; cursor: pointer; }
        .nav .logout { background: #e53e3e; }
        .welcome { font-size: 1.5em; font-weight: bold; margin-bottom: 0; }
        .username { color: #2b6cb0; }
        .panel { border: 1px solid #ccc; padding: 16px; border-radius: 8px; background: #fff; margin-top: 24px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #f4f6fb; }
        .status-pending { color: #e53e3e; font-weight: bold; }
    .status-rescued { color: #38a169; font-weight: bold; }
    </style>
</head>
<body>
    <div class="topbar">
        <div>
            <div class="welcome">Welcome, <span class="username">{{ session('user_email') ?? 'Admin' }}</span>!</div>
        </div>
        <div class="nav">
            <a href="{{ route('admin.adoption') }}">Adoption</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="panel">
        <h3>Reported Pets</h3>
        @if(isset($pets) && $pets->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rescuer's Name</th>
                        <th>Address</th>
                        <th>Location</th>
                        <th>Condition</th>
                        <th>Kind</th>
                        <th>Color</th>
                        <th>Contact</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pets as $index => $pet)
                    <tr>
                        <td>Pet #{{ $index + 1 }}</td>
                        <td>{{ $pet['full_name'] ?? 'N/A' }}</td>
                        <td>{{ $pet['address'] ?? 'N/A' }}</td>
                        <td>{{ $pet['location'] ?? 'N/A' }}</td>
                        <td>{{ $pet['condition'] ?? 'N/A' }}</td>
                        <td>{{ $pet['kind'] ?? 'N/A' }}</td>
                        <td>{{ $pet['color'] ?? 'N/A' }}</td>
                        <td>{{ $pet['contact'] ?? 'N/A' }}</td>
                        <td>
                            @php $s = $pet['status'] ?? 'Pending'; @endphp
                            @if($s === 'Pending' || $s === 'not yet rescue')
                                <!-- Pending Response (red) -->
                                <button onclick="markAsRescued({{ $pet->id }}, this)" data-id="{{ $pet->id }}" style="background:#e53e3e;color:#fff;border:none;padding:6px 10px;border-radius:6px;">Pending Response</button>
                            @elseif($s === 'Ready for Adoption')
                                <!-- Rescued (green) -->
                                <button onclick="markAsRescued({{ $pet->id }}, this)" data-id="{{ $pet->id }}" style="background:#38a169;color:#fff;border:none;padding:6px 10px;border-radius:6px;">Rescued</button>
                            @elseif($s === 'Rescued')
                                <!-- Rescued but not yet Ready for Adoption: non-clickable (admin-dashboard view should not change further) -->
                                <button style="background:#38a169;color:#fff;border:none;padding:6px 10px;border-radius:6px;" disabled>Rescued</button>
                            @elseif($s === 'Adopted')
                                <button style="background:#38a169;color:#fff;border:none;padding:6px 10px;border-radius:6px;" disabled>Adopted</button>
                            @else
                                <span>{{ $s }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script>
        async function markAsRescued(id, btn) {
        if (!confirm('Marked this pet as rescued?')) return;
            const token = '{{ csrf_token() }}';
            try {
                const res = await fetch('/admin/rescue/' + id + '/status', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                    body: JSON.stringify({ status: 'Rescued' })
                });
                const data = await res.json();
                if (data.success) {
                    // update the existing button to preserve design
                    const statusText = data.status || 'Pending';
                    if (statusText === 'Pending' || statusText === 'not yet rescue') {
                        btn.style.background = '#e53e3e';
                        btn.style.color = '#fff';
                        btn.innerText = 'Pending Response';
                        btn.disabled = false;
                    } else if (statusText === 'Ready for Adoption' || statusText === 'Rescued') {
                        btn.style.background = '#38a169';
                        btn.style.color = '#fff';
                        btn.innerText = 'Rescued';
                        // if it's the DB state 'Rescued' the admin-dashboard should not allow further clicks
                        if (statusText === 'Rescued') {
                            btn.disabled = true;
                        } else {
                            btn.disabled = false;
                        }
                    } else if (statusText === 'Adopted') {
                        btn.style.background = '#38a169';
                        btn.style.color = '#fff';
                        btn.innerText = 'Adopted';
                        btn.disabled = true;
                    } else {
                        btn.innerText = statusText;
                    }
                } else {
                    alert(data.message || 'Update failed');
                }
            } catch (e) {
                alert('Network error');
            }
        }
    </script>
</body>
</html>
