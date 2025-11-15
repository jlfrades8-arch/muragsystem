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
        $pets = Rescue::with('adoptions')->where('status', 'Ready for Adoption')->orderBy('created_at', 'desc')->get();

        // Build map of pending adoptions for quick lookup in views
        $pendingAdoptionsByRescueId = [];
        foreach ($pets as $pet) {
            $pending = $pet->adoptions->whereNull('adopted_at');
            if ($pending->count() > 0) {
                $pendingAdoptionsByRescueId[$pet->id] = $pending;
            }
        }

        // Return the adoption listing view which can disable adopt actions for pending items.
        return view('adoption-list', compact('pets', 'pendingAdoptionsByRescueId'));

        // Build map of pending adoptions for quick lookup in views
        $pendingAdoptionsByRescueId = [];
        foreach ($pets as $pet) {
            $pending = $pet->adoptions->filter(fn($a) => $a->adopted_at === null);
            if ($pending->count() > 0) {
                $pendingAdoptionsByRescueId[$pet->id] = $pending;
            }
        }

        // Return the adoption listing view.
        return view('adoption-list', compact('pets', 'pendingAdoptionsByRescueId'));
    }

    // Show adoption form for selected pet
    public function form($id)
    {
        $pet = Rescue::with('adoptions')->find($id);
        if (!$pet || ($pet->status ?? '') !== 'Ready for Adoption') {
            return redirect()->route('adoption.list')->with('error', 'Pet not found or not available for adoption.');
        }

        $hasPendingAdoption = $pet->adoptions->whereNull('adopted_at')->count() > 0;

        return view('adoption-detail', compact('pet', 'hasPendingAdoption'));
    }

    // Handle form submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required',
            'adopter_name' => 'required|string',
            'contact' => ['required', 'string', 'regex:/^(09|\+639)\d{9}$/'],
            // 'photo' removed
        ], [
            'contact.regex' => 'Please enter a valid Philippine mobile number (e.g., 09171234567 or +639171234567)'
        ]);

        // Persist adoption by marking the rescue record as Adopted
        $pet = Rescue::find($validated['pet_id']);
        if (!$pet || $pet->status !== 'Ready for Adoption') {
            return redirect()->route('adoption')->with('error', 'Pet not available for adoption.');
        }

        // create adoption record but DO NOT mark the rescue as Adopted yet.
        // The adoption remains pending until an admin confirms it.
        // If there is already a pending adoption for this rescue, reject additional submissions
        $existingPending = Adoption::where('rescue_id', $pet->id)->whereNull('adopted_at')->exists();
        if ($existingPending) {
            return redirect()->route('adoption.list')->with('error', 'This pet already has a pending adoption request.');
        }

        // Store the uploaded photo if present
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('adoptions', 'public');
        }

        Adoption::create([
            'rescue_id' => $pet->id,
            'adopter_name' => $validated['adopter_name'],
            'adopter_email' => session('user_email'),
            'photo' => $photoPath,
            // adopted_at will be set when admin confirms the adoption
        ]);

        // Mark the rescue as pending for adoption so admins see it in the pending list
        $pet->status = 'Pending for Adoption';
        $pet->save();

        return redirect()->route('my.adoptions')->with('success', 'Adoption request submitted. Pending admin confirmation.');
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
