<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RescueController extends Controller
{
    // Show the rescue form
public function showForm()
{
    // Get all rescued pets from session
    $pets = session('rescued_pets', []);

    // Count how many pets have already been submitted
    $nextIndex = count($pets);

    // Return view with pets and nextIndex
    return view('rescue-form', compact('pets', 'nextIndex'));
}

    // Handle form submission
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'pets' => 'required|array|min:1',
            'pets.*.full_name' => 'required|string|max:255',
            'pets.*.address' => 'required|string',
            'pets.*.location' => 'required|string',
            'pets.*.condition' => 'required|string',
            'pets.*.kind' => 'required|string',
            'pets.*.contact' => 'required|string',
        ]);

        // Merge new pets into session
        $allPets = session('rescued_pets', []);
        $allPets = array_merge($allPets, $validated['pets']);
        session(['rescued_pets' => $allPets]);

        return redirect()->route('rescue.confirmation');
    }

    // Show confirmation
    public function confirmation()
    {
        $pets = session('rescued_pets', []);
        return view('rescue-confirmation', compact('pets'));
    }
    // Show all reported pets
public function list()
{
    // Get all rescued pets from session
    $pets = session('rescued_pets', []);

    return view('rescue-list', compact('pets'));
}

}
