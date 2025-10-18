<!DOCTYPE html>
<html>
<head>
    <title>Rescue Detail (Admin)</title>
</head>
<body>
    <h2>Rescue Detail</h2>
    <p><strong>Full Name:</strong> {{ $pet->full_name }}</p>
    <p><strong>Address:</strong> {{ $pet->address }}</p>
    <p><strong>Location:</strong> {{ $pet->location }}</p>
    <p><strong>Condition:</strong> {{ $pet->condition }}</p>
    <p><strong>Kind:</strong> {{ $pet->kind }}</p>
    <p><strong>Color:</strong> {{ $pet->color }}</p>
    <p><strong>Contact:</strong> {{ $pet->contact }}</p>
    <p><strong>Status:</strong> {{ $pet->status }}</p>

    <a href="{{ route('admin.rescue.reports') }}">← Back to Reports</a>
</body>
</html>