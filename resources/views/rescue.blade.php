<!DOCTYPE html>
<html>
<head>
    <title>Rescue Form</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 40px; }
        .form-container { max-width: 800px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        .pet-entry { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px; background-color: #f9f9f9; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc; }
        .add-btn, .remove-btn { margin-top: 15px; background-color: #007bff; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; }
        .remove-btn { background-color: #dc3545; }
        .submit-btn { margin-top: 30px; width: 100%; padding: 12px; background-color: #28a745; color: white; font-size: 16px; border: none; border-radius: 5px; }
    </style>
    <script>
        let petIndex = 1;

        function addPetEntry() {
            const container = document.getElementById('pet-entries');
            const original = document.querySelector('.pet-entry');
            const clone = original.cloneNode(true);
            clone.querySelectorAll('input, textarea').forEach(input => {
                const nameAttr = input.getAttribute('name');
                const newName = nameAttr.replace(/\[\d+\]/, `[${petIndex}]`);
                input.setAttribute('name', newName);
                input.value = '';
            });
            container.appendChild(clone);
            petIndex++;
        }

        function removePetEntry(button) {
            const container = document.getElementById('pet-entries');
            if (container.children.length > 1) {
                button.parentNode.remove();
            } else {
                alert('At least one pet entry is required.');
            }
        }
    </script>
</head>
<body>

<div class="form-container">
    <h2>Report Multiple Pet Rescues</h2>

    <form method="POST" action="{{ route('rescue.submit') }}">
        @csrf

        <div id="pet-entries">
            <div class="pet-entry">
                <label>Full Name:</label>
                <input type="text" name="pets[0][name]" required>

                <label>Address (Where you saw the pet):</label>
                <textarea name="pets[0][address]" required></textarea>

                <label>Condition of the Pet:</label>
                <textarea name="pets[0][condition]" required></textarea>

                <label>Kind of Pet:</label>
                <input type="text" name="pets[0][kind]" required>

                <label>Contact Number:</label>
                <input type="text" name="pets[0][contact]" required>

                <button type="button" class="remove-btn" onclick="removePetEntry(this)">Remove</button>
            </div>
        </div>

        <button type="button" class="add-btn" onclick="addPetEntry()">+ Add Another Pet</button>

        <button type="submit" class="submit-btn">Submit Rescues</button>
    </form>
</div>

</body>
</html>
