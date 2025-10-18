<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescue;

class RescueController extends Controller
{
    // Show the rescue form
    public function form()
    {
        $nextIndex = Rescue::count();
        return view('rescue-form', compact('nextIndex'));
    }

    // Persist submitted rescue(s) to the database
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'pets.*.full_name' => 'required|string',
            'pets.*.address' => 'required|string',
            'pets.*.location' => 'required|string',
            'pets.*.condition' => 'required|string',
            'pets.*.kind' => 'required|string',
            'pets.*.color' => 'nullable|string',
            'pets.*.contact' => 'required|string',
            'pets.*.image' => 'nullable|image|mimes:jpeg,jpg,png|max:10240', // 10MB max
        ]);

        foreach ($validated['pets'] as $index => $petData) {
            // Handle image upload
            if ($request->hasFile("pets.{$index}.image")) {
                $image = $request->file("pets.{$index}.image");
                $imagePath = $image->store('rescues', 'public');
                $petData['image'] = $imagePath;
            }

            // Ensure new reports start as 'not yet rescue'
            if (!isset($petData['status']) || empty($petData['status'])) {
                $petData['status'] = 'not yet rescue';
            }

            Rescue::create($petData);
        }

        return redirect()->route('rescue.list')->with('success', 'Pet reported successfully!');
    }

    // List rescues from database
    public function list()
    {
        $pets = Rescue::orderBy('created_at', 'desc')->get();
        return view('rescue-list', compact('pets'));
    }

    // Mark a rescue as rescued (by id)
    public function markRescued($id)
    {
        // only admins are allowed to mark as rescued
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized');
        }

        $rescue = Rescue::find($id);
        if ($rescue) {
            // Admin action: set the pet as Ready for Adoption (makes it available for users to adopt)
            $rescue->update(['status' => 'Ready for Adoption']);

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Pet is now ready for adoption!']);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Pet is now ready for adoption!');
    }
}
