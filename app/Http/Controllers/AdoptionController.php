<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    // Show list of pets available for adoption in dashboard layout
    public function index()
    {
        $pets = session('adoption_pets', [
            ['id' => 1, 'name' => 'Luna', 'kind' => 'Cat', 'age' => 2],
            ['id' => 2, 'name' => 'Buddy', 'kind' => 'Dog', 'age' => 3],
            ['id' => 3, 'name' => 'Thumper', 'kind' => 'Rabbit', 'age' => 1],
        ]);

        return view('user-adoption', compact('pets'));
    }

    // Show adoption form for selected pet
    public function form($id)
    {
        $pets = session('adoption_pets', []);
        $pet = collect($pets)->firstWhere('id', $id);

        if (!$pet) {
            return redirect()->route('adoption')->with('error', 'Pet not found.');
        }

        return view('adoption-form', compact('pet'));
    }

    // Handle form submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required',
            'adopter_name' => 'required|string',
            'contact' => 'required|string',
        ]);

        $adoptions = session('adoptions', []);
        $adoptions[] = $validated;
        session(['adoptions' => $adoptions]);

        return redirect()->route('adoption')->with('success', 'Adoption request submitted!');
    }
}
