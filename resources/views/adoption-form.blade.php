<!DOCTYPE html>
<html>
<head>
    <title>Adopt {{ $pet['name'] }}</title>
    <style>
        body { font-family: Arial; margin:20px; }
        label { display:block; margin-top:8px; }
        input { width:100%; padding:8px; margin-top:4px; }
        button { margin-top:12px; padding:10px 15px; cursor:pointer; }
    </style>
</head>
<body>
    <h2>Adopt {{ $pet['name'] }}</h2>

    <form action="{{ route('adoption.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="pet_id" value="{{ $pet['id'] }}">

        <label>Your Name:</label>
        <input type="text" name="adopter_name" required>

        <label>Contact Number:</label>
        <input type="text" name="contact" required>

        <button type="submit">Submit Adoption</button>
    </form>

    <br>
    <a href="{{ route('adoption') }}">Back to Pet List</a>
</body>
</html>
