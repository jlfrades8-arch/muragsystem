<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header */
        .header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 20px;
        }

        /* Layout: sidebar + content */
        .container {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 150px;
            background-color: #dee2e6;
            padding: 20px;
            height: calc(100vh - 70px); /* Full height minus header */
        }

        .sidebar button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            background-color: #6c757d;
            color: white;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #495057;
        }

        /* Main content area */
        .content {
            flex: 1;
            padding: 30px;
        }

        /* Each pet card */
        .pet-card {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .pet-card button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        Welcome, {{ session('user_email') ?? 'User' }}
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <button onclick="window.location.href='{{ route('adoption') }}'">Adoption</button>
            <button onclick="window.location.href='{{ route('logout') }}'" style="margin-top: 20px;">Logout</button>
        </div>

        <!-- Main content -->
        <div class="content">
            <h2>Pets Available for Adoption</h2>

            @if(session('success'))
                <p style="color:green;">{{ session('success') }}</p>
            @endif

            @if(session('error'))
                <p style="color:red;">{{ session('error') }}</p>
            @endif

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
                    <a href="{{ route('adoption.form', $pet->id) }}"><button>Adopt</button></a>
                </div>
            @empty
                <p>No pets available for adoption right now.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
