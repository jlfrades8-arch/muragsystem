<!DOCTYPE html>
<html>
<head>
    <title>Rescue Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .pet-block { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; }
        label { display: block; margin-top: 8px; }
        input[type="text"], input[type="tel"] { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 10px; padding: 10px 15px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Rescue Form</h2>

    <!-- Button to View Reported Pets -->
    <a href="{{ route('rescue.list') }}">
        <button type="button">View Reported Pets</button>
    </a>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rescue.submit') }}" method="POST">
        @csrf

        <div id="pets-container">
            @php
                $startIndex = $nextIndex ?? 0; // next pet number
            @endphp

            <!-- Only show a single new pet block -->
            <div class="pet-block">
                <h4>Pet #{{ $startIndex + 1 }}</h4>

                <label>Full Name of the User:</label>
                <input type="text" name="pets[{{ $startIndex }}][full_name]" required>

                <label>Address where you saw the pet:</label>
                <input type="text" name="pets[{{ $startIndex }}][address]" required>

                <label>Location description:</label>
                <input type="text" name="pets[{{ $startIndex }}][location]" required>

                <label>Condition of the pet:</label>
                <input type="text" name="pets[{{ $startIndex }}][condition]" required>

                <label>Kind of pet:</label>
                <input type="text" name="pets[{{ $startIndex }}][kind]" required>

                <label>Contact number:</label>
                <input type="tel" name="pets[{{ $startIndex }}][contact]" required>
            </div>
        </div>

        <br>
        <button type="submit">Submit</button>
    </form>

    <br>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

</body>
</html>
