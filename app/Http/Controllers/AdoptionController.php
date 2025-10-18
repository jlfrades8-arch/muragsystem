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

        $pet->update(['status' => 'Adopted']);

        return redirect()->route('adoption')->with('success', 'Adoption completed. Thank you!');
    }
}
