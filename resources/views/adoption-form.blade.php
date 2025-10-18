<!DOCTYPE html>
<html>
<head>
    <title>Available Pets for Adoption</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .pet-block { 
            margin-bottom: 20px; 
            padding: 15px; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            background-color: #f9f9f9; 
        }
        button { 
            padding: 8px 12px; 
            background-color: #28a745; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

<h2>Available Pets for Adoption</h2>

@if(count($pets) === 0)
    <p>No pets are available for adoption at the moment.</p>
@else
    @foreach($pets as $index => $pet)
        <div class="pet-block">
            <h4>Pet #{{ $index + 1 }}</h4>
            <p><strong>Kind:</strong> {{ $pet['kind'] }}</p>
            <p><strong>Color:</strong> {{ $pet['color'] }}</p>
           

            <!-- ✅ Adopt button with pet data -->
            <form action="{{ route('adoption.form') }}" method="GET">
                <input type="hidden" name="kind" value="{{ $pet['kind'] }}">
                <input type="hidden" name="color" value="{{ $pet['color'] }}">
        
                <button type="submit">Adopt</button>
            </form>
        </div>
    @endforeach
@endif

<a href="{{ route('login') }}">← Back to Login</a>

</body>
</html>
        