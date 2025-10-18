<!DOCTYPE html>
<html>
<head>
    <title>Adoption Detail</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .card { padding: 16px; border: 1px solid #ddd; border-radius: 8px; background:#fff; }
        label { display:block; margin-top:8px; }
    </style>
</head>
<body>

    <h2>Adopt this Pet</h2>

    <div class="card">
        @if(!empty($pet->image_url))
            <img src="{{ $pet->image_url }}" alt="pet-image" style="width:200px;height:200px;object-fit:cover;border-radius:8px;float:right;margin-left:16px;" />
        @endif
    <h2 style="margin-top:0">{{ $pet->pet_name ?? ($pet->full_name ? 'Pet of ' . $pet->full_name : 'Unnamed Pet') }}</h2>
    <p><strong>Rescuer:</strong> {{ $pet->full_name ?? 'Unknown' }}</p>
    <p><strong>Kind:</strong> {{ $pet->kind }}</p>
        <p><strong>Color:</strong> {{ $pet->color }}</p>
        <p><strong>Condition:</strong> {{ $pet->condition }}</p>

        <form action="{{ route('adoption.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="pet_id" value="{{ $pet->id }}">
            <label>Your name</label>
            <input type="text" name="adopter_name" required>
            <label>Contact</label>
            <input type="text" name="contact" required>
            <br><br>
            <button type="submit">Submit Adoption Request</button>
        </form>
    </div>

    <br>
    <a href="{{ route('adoption') }}">← Back to Adoption List</a>
</body>
</html>