<!DOCTYPE html>
<html>
<head>
    <title>Admin - Adoption</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display:flex; justify-content:space-between; align-items:center; }
        .pet-card { background:#fff; padding:12px; border:1px solid #ddd; border-radius:8px; margin-bottom:12px; }
        .pet-card .meta { color:#555; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Adoption (Admin view)</h2>
    <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
    </div>

    @forelse($pets as $pet)
        <div class="pet-card" id="pet-{{ $pet->id }}">
            <p>
                <strong>Rescuer's Name:</strong>
                <span id="name-display-{{ $pet->id }}">{{ $pet->full_name ?? 'N/A' }}</span>
            </p>

            <p>
                <strong>Pet Name:</strong>
                <span id="pet-name-display-{{ $pet->id }}">{{ $pet->pet_name ?? 'Unnamed' }}</span>
                <input type="text" id="pet-name-input-{{ $pet->id }}" value="{{ $pet->pet_name ?? '' }}" style="margin-left:8px; padding:4px;" />
                <button onclick="savePetName({{ $pet->id }})" style="margin-left:6px; padding:4px 6px">Save</button>
            </p>
            <p><strong>Contact:</strong> {{ $pet->contact ?? 'No contact' }}</p>
            <p class="meta"><strong>Kind:</strong> {{ $pet->kind }}  <strong>Color:</strong> {{ $pet->color }}</p>
            <p><strong>Status:</strong>
                @php
                    // In DB flow: if the record's status is 'Rescued' we want to display 'Rescued'; otherwise show the raw status or default to 'not yet rescue'
                    $raw = $pet->status ?? 'not yet rescue';
                    $st = ($raw === 'Rescued') ? 'Rescued' : $raw;
                @endphp
                    <div style="display:flex; gap:8px; align-items:center;">
                        <button class="status-btn" onclick="changeStatus({{ $pet->id }}, this)"
                            style="background: {{ $st === 'Ready for Adoption' ? '#38a169' : '#e53e3e' }}; color:#fff; border:none; padding:6px 10px; border-radius:6px;" {{ $st === 'Adopted' ? 'disabled' : '' }}>
                            {{ $st }}
                        </button>

                        {{-- Image preview and upload --}}
                        @if(!empty($pet->image))
                            <img src="{{ asset('storage/' . $pet->image) }}" alt="pet-image" style="width:72px;height:72px;object-fit:cover;border-radius:6px;border:1px solid #ddd;" />
                        @endif

                        <div>
                            <input type="file" id="image-{{ $pet->id }}" accept="image/*" />
                            <button onclick="uploadImage({{ $pet->id }})" style="padding:6px 8px;margin-left:6px">Upload</button>
                        </div>
                    </div>
            </p>
        </div>
    @empty
        <p>No pets found.</p>
    @endforelse

    <script>
        async function changeStatus(id, btn) {
            const current = btn.innerText.trim();
            // allow changing from 'not yet rescue' or 'Rescued' to 'Ready for Adoption'
            if (current === 'not yet rescue' || current === 'Rescued') {
                if (!confirm('Change status to Ready for Adoption?')) return;
                const token = '{{ csrf_token() }}';
                try {
                    const res = await fetch('/admin/rescue/' + id + '/status', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                        body: JSON.stringify({ status: 'Ready for Adoption' })
                    });
                    const data = await res.json();
                    if (data.success) {
                        const statusText = data.status || 'Ready for Adoption';
                        btn.innerText = statusText;
                // styling: not yet rescue (red), Ready (green), Adopted (green disabled), Rescued (red label)
                    if (statusText === 'not yet rescue' || statusText === 'Rescued') {
                            btn.style.background = '#e53e3e';
                            btn.style.color = '#fff';
                        } else if (statusText === 'Ready for Adoption') {
                            btn.style.background = '#38a169';
                            btn.style.color = '#fff';
                        } else if (statusText === 'Adopted') {
                            btn.style.background = '#2f855a';
                            btn.style.color = '#fff';
                            btn.disabled = true;
                        }
                    } else {
                        alert(data.message || 'Update failed');
                    }
                } catch (e) {
                    alert('Network error');
                }
            } else {
                // do not allow changes for Ready/Adopted here; you can extend this to other transitions
                alert('This status cannot be changed from this view.');
            }
        }
    </script>
    <script>
        async function uploadImage(id) {
            const input = document.getElementById('image-' + id);
            if (!input || !input.files || input.files.length === 0) {
                alert('Please choose an image file first.');
                return;
            }
            if (!confirm('Upload this image for the pet?')) return;

            const file = input.files[0];
            const form = new FormData();
            form.append('image', file);

            try {
                const res = await fetch('/admin/rescue/' + id + '/upload-image', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: form
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    // replace or insert img thumbnail
                    const card = document.getElementById('pet-' + id);
                    let img = card.querySelector('img');
                    if (!img) {
                        img = document.createElement('img');
                        img.style.width = '72px';
                        img.style.height = '72px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '6px';
                        img.style.border = '1px solid #ddd';
                        // insert before the file input container
                        const inputEl = card.querySelector('#image-' + id);
                        inputEl.parentNode.insertBefore(img, inputEl);
                    }
                    img.src = data.image;
                    alert('Image uploaded');
                } else {
                    alert(data.message || 'Upload failed');
                }
            } catch (e) {
                console.error(e);
                alert('Network error');
            }
        }
    </script>

    


    <script>
        async function savePetName(id) {
            const input = document.getElementById('pet-name-input-' + id);
            if (!input) return;
            const value = input.value.trim();
            if (!value) { alert('Pet name cannot be empty'); return; }
            if (!confirm('Save this pet name?')) return;
            const token = '{{ csrf_token() }}';
            try {
                const res = await fetch('/admin/rescue/' + id + '/update-pet-name', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                    body: JSON.stringify({ pet_name: value })
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    document.getElementById('pet-name-display-' + id).innerText = data.pet_name;
                    alert('Pet name updated');
                } else {
                    alert(data.message || 'Update failed');
                }
            } catch (e) {
                console.error(e);
                alert('Network error');
            }
        }
    </script>

</body>
</html>
