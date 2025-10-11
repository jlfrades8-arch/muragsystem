    <!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption List</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .pet { border:1px solid #ccc; padding:15px; margin-bottom:10px; border-radius:5px; }
        button { padding:8px 12px; margin-top:8px; cursor:pointer; }
    </style>
</head>
<body>
    <h2>Pets Available for Adoption</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    @foreach($pets as $pet)
        <div class="pet">
            <p><strong>Name:</strong> {{ $pet['name'] }}</p>
            <p><strong>Kind:</strong> {{ $pet['kind'] }}</p>
            <p><strong>Age:</strong> {{ $pet['age'] }} years</p>
            <a href="{{ route('adoption.form', $pet['id']) }}"><button>Adopt</button></a>
        </div>
    @endforeach

    <br>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>
