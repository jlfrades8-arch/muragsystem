<!DOCTYPE html>
<html>
<head>
    <title>Reported Pets</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .pet-block { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; }
    </style>
</head>
<body>

<h2>List of Reported Pets</h2>

@if(count($pets) === 0)
    <p>No pets have been reported yet.</p>
@else
    @foreach($pets as $index => $pet)
        <div class="pet-block">
            <h4>Pet #{{ $index + 1 }}</h4>
            <p><strong>Full Name:</strong> {{ $pet['full_name'] ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $pet['address'] }}</p>
            <p><strong>Location:</strong> {{ $pet['location'] }}</p>
            <p><strong>Condition:</strong> {{ $pet['condition'] }}</p>
            <p><strong>Kind:</strong> {{ $pet['kind'] }}</p>
            <p><strong>Contact:</strong> {{ $pet['contact'] }}</p>
        </div>
    @endforeach
@endif

<a href="{{ route('rescue.form') }}">← Back to Rescue Form</a>
</body>
</html>
