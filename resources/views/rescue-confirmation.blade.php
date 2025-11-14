<!DOCTYPE html>
<html>
<head>
    <title>Rescue Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .pet-block { margin-bottom: 20px; padding: 15px; border: 1px solid #333; border-radius: 8px; }
        button { padding: 10px 15px; margin-top: 10px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Rescue Confirmation</h2>

    @if(is_array($pets) && count($pets) > 0)
        @foreach($pets as $index => $pet)
            <div class="pet-block">
                <h3>Pet #{{ $index + 1 }}</h3>
                <p><strong>Full Name:</strong> {{ $pet['full_name'] }}</p>
                <p><strong>Address:</strong> {{ $pet['address'] }}</p>
                <p><strong>Location:</strong> {{ $pet['location'] }}</p>
                <p><strong>Condition:</strong> {{ $pet['condition'] }}</p>
                <p><strong>Kind:</strong> {{ $pet['kind'] }}</p>
                <p><strong>Color of Pet:</strong> {{ $latest['color'] }}</p>
                <p><strong>Contact:</strong> {{ $pet['contact'] }}</p>
            </div>
        @endforeach
    @else
        <p>No pets submitted.</p>
    @endif

    <!-- Add More Pet button -->
    <form action="{{ route('rescue.form') }}" method="GET" style="display:inline;">
        <button type="submit">Add More Pet</button>
    </form>

    <a href="{{ route('dashboard') }}" style="margin-left: 15px;">Back to Dashboard</a>

</body>
</html>
