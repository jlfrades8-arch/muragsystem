<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rescue Reports - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; }
        .nav { display: flex; gap: 12px; align-items: center; }
        .nav a { text-decoration: none; padding: 8px 12px; background: #2b6cb0; color: #fff; border-radius: 6px; }
        .nav a.logout { background: #e53e3e; }
        .container { margin-top: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #f4f6fb; }
        .actions button { margin-right: 6px; padding: 6px 10px; }
        .panel { border: 1px solid #ccc; padding: 12px; border-radius: 8px; background: #fff; }
        .welcome { font-weight: 600; }
        .username { font-size: 14px; color: #555; }
    </style>
</head>
<body>

    <div class="topbar">
        <div>
            <h2>Rescue Reports</h2>
            <div class="welcome">Welcome, <span class="username">{{ Auth::user()->name ?? 'Admin' }}</span></div>
        </div>

        <div class="nav">
            <a href="{{ route('admin.rescue.reports') }}">Rescue Reports</a>
            <a href="{{ route('admin.adoption') }}">Adoption</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="panel">
            <h3>Reported Pets</h3>

            @if(session('status'))
                <div style="padding:8px;background:#e6fffa;border:1px solid #b2f5ea;margin-bottom:12px;">{{ session('status') }}</div>
            @endif

            @if(isset($pets) && $pets->count())
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Reporter</th>
                            <th>Address</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Kind</th>
                            <th>Color</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pets as $i => $pet)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $pet->full_name ?? data_get($pet, 'full_name') }}</td>
                                <td>{{ $pet->address ?? data_get($pet, 'address') }}</td>
                                <td>{{ $pet->location ?? data_get($pet, 'location') }}</td>
                                <td>{{ $pet->condition ?? data_get($pet, 'condition') }}</td>
                                <td>{{ $pet->kind ?? data_get($pet, 'kind') }}</td>
                                <td>{{ $pet->color ?? data_get($pet, 'color') }}</td>
                                <td>{{ $pet->contact ?? data_get($pet, 'contact') }}</td>
                                <td>{{ $pet->status ?? data_get($pet, 'status', 'Pending') }}</td>
                                <td class="actions">
                                    <a href="{{ route('rescue.show', ['id' => $pet->id ?? $i]) }}"><button type="button">View</button></a>
                                    <form action="{{ route('rescue.updateStatus', ['id' => $pet->id ?? $i]) }}" method="POST" style="display:inline">
                                        @csrf
                                        <select name="status">
                                            <option value="Pending" {{ ( ($pet->status ?? '') == 'Pending') ? 'selected' : '' }}>Pending</option>
                                            <option value="In Progress" {{ ( ($pet->status ?? '') == 'In Progress') ? 'selected' : '' }}>In Progress</option>
                                            <option value="Resolved" {{ ( ($pet->status ?? '') == 'Resolved') ? 'selected' : '' }}>Resolved</option>
                                        </select>
                                        <button type="submit">Change</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>No reported pets yet.</div>
            @endif
        </div>
    </div>

</body>
</html>
