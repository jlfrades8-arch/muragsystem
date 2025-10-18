<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescue;

class AdoptionController extends Controller
{
    // Show list of pets available for adoption in dashboard layout
    public function index()
    {
        // show rescues that have status 'Ready for Adoption' (available for adoption)
        $pets = Rescue::where('status', 'Ready for Adoption')->orderBy('created_at', 'desc')->get();
        return view('user-adoption', compact('pets'));
    }

    // Show adoption form for selected pet
    public function form($id)
    {
        $pet = Rescue::find($id);
        if (!$pet || ($pet->status ?? '') !== 'Ready for Adoption') {
            return redirect()->route('adoption')->with('error', 'Pet not found or not available for adoption.');
        }

        return view('adoption-detail', compact('pet'));
    }

    // Handle form submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required',
            'adopter_name' => 'required|string',
            'contact' => 'required|string',
        ]);

        // Persist adoption by marking the rescue record as Adopted
        $pet = Rescue::find($validated['pet_id']);
        if (!$pet || $pet->status !== 'Ready for Adoption') {
            return redirect()->route('adoption')->with('error', 'Pet not available for adoption.');
        }

    $pet->update(['status' => 'Adopted', 'adopter_email' => session('user_email'), 'adopter_name' => $validated['adopter_name']]);

        return redirect()->route('my.adoptions')->with('success', 'Adoption completed. Thank you!');
    }

    // Show the current user's adopted pets
    public function myAdoptions()
    {
        $email = session('user_email');
        if (!$email) {
            return redirect()->route('adoption')->with('error', 'Please log in to see your adoptions.');
        }
        $pets = Rescue::where('adopter_email', $email)->orderBy('updated_at', 'desc')->get();
        return view('my-adoptions', compact('pets'));
    }
}
