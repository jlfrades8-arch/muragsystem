<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescue;
use App\Models\Adoption;

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

        // create adoption record and mark rescue as adopted
        Adoption::create([
            'rescue_id' => $pet->id,
            'adopter_name' => $validated['adopter_name'],
            'adopter_email' => session('user_email'),
            'adopted_at' => now(),
        ]);

        $pet->update(['status' => 'Adopted']);

        return redirect()->route('my.adoptions')->with('success', 'Adoption completed. Thank you!');
    }

    // Show the current user's adopted pets
    public function myAdoptions()
    {
        $email = session('user_email');
        if (!$email) {
            return redirect()->route('adoption')->with('error', 'Please log in to see your adoptions.');
        }

        $adoptions = Adoption::with('rescue')->where('adopter_email', $email)->orderBy('adopted_at', 'desc')->get();
        return view('my-adoptions', compact('adoptions'));
    }
}
