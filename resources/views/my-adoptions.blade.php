<!DOCTYPE html>
<html>
<head>
    <title>My Adoptions</title>
    <style>
        body { margin:0; font-family:Arial, sans-serif; background:#f8f9fa; }
        .header { background:#343a40; color:#fff; text-align:center; padding:18px; }
        .container { display:flex; }
        .sidebar { width:150px; background:#dee2e6; padding:20px; height:calc(100vh - 70px); }
        .content { flex:1; padding:30px; }
        .pet-card { background:#fff; padding:20px; margin-bottom:20px; border-radius:10px; box-shadow:0 0 10px #ccc; }
    </style>
</head>
<body>
    <div class="header">Welcome, {{ session('user_email') ?? 'User' }}</div>
    <div class="container">
        <div class="sidebar">
            <button onclick="window.location.href='{{ route('adoption') }}'">Adoption</button>
            <button onclick="window.location.href='{{ route('logout') }}'" style="margin-top:20px;">Logout</button>
        </div>
        <div class="content">
            <h2>My Adopted Pets</h2>
            @if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif
            @forelse($pets as $pet)
                <div class="pet-card">
                    @if(!empty($pet->image_url))
                        <img src="{{ $pet->image_url }}" alt="pet-image" style="width:150px;height:150px;object-fit:cover;border-radius:8px;float:right;margin-left:20px;" />
                    @endif
                    <h3 style="margin-top:0">{{ $pet->pet_name ?? ($pet->full_name ? 'Pet of ' . $pet->full_name : 'Unnamed Pet') }}</h3>
                    <p><strong>Rescuer:</strong> {{ $pet->full_name ?? 'Unknown' }}</p>
                    <p><strong>Kind:</strong> {{ $pet->kind }}</p>
                    <p><strong>Color:</strong> {{ $pet->color }}</p>
                    <p><strong>Condition:</strong> {{ $pet->condition }}</p>
                </div>
            @empty
                <p>You haven't adopted any pets yet.</p>
            @endforelse
        </div>
    </div>
</body>
</html>