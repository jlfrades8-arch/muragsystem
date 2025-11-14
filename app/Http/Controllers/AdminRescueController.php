<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescue;
use Illuminate\Support\Facades\Storage;

class AdminRescueController extends Controller
{
    public function index()
    {
        $pets = Rescue::orderBy('created_at', 'desc')->get();
        $pendingCount = $pets->whereIn('status', ['Pending', 'not yet rescue', 'Pending for Adoption'])->count();
        return view('admin-reports', compact('pets', 'pendingCount'));
    }

    public function show($id)
    {
        $pet = Rescue::find($id);
        if (!$pet) return redirect()->route('admin.rescue.reports')->with('status', 'Pet not found');

        $pets = Rescue::orderBy('created_at', 'desc')->get();
        $pendingCount = $pets->whereIn('status', ['Pending', 'not yet rescue', 'Pending for Adoption'])->count();

        return view('rescue-detail-admin', compact('pet', 'pets', 'pendingCount'));
    }

    public function updateStatus(Request $request, $id)
    {
        // only admins may change status
        if (session('role') !== 'admin') {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            return redirect()->route('admin.rescue.reports')->with('status', 'Unauthorized');
        }
        $request->validate(['status' => 'required|string']);
        $pet = Rescue::find($id);
        if (!$pet) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Pet not found'], 404);
            }
            return redirect()->route('admin.rescue.reports')->with('status', 'Pet not found');
        }
        $newStatus = $request->input('status');
        $pet->update(['status' => $newStatus]);

        // If admin marks the rescue as Adopted, mark the earliest pending adoption as adopted
        if ($newStatus === 'Adopted') {
            $adoption = \App\Models\Adoption::where('rescue_id', $pet->id)
                ->whereNull('adopted_at')
                ->orderBy('created_at', 'asc')
                ->first();

            if ($adoption) {
                $adoption->adopted_at = now();
                $adoption->save();
            }
        }
        // If this is an AJAX/JS request, return JSON so client can update without redirect
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'status' => $pet->status]);
        }

        return redirect()->route('admin.rescue.reports')->with('status', 'Status updated.');
    }

    public function uploadImage(Request $request, $id)
    {
        if (session('role') !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate(['image' => 'required|image|max:5120']); // max 5MB

        $pet = Rescue::find($id);
        if (!$pet) return response()->json(['success' => false, 'message' => 'Pet not found'], 404);

        $path = $request->file('image')->store('rescues', 'public');
        // store the public path
        $pet->update(['image' => $path]);

        return response()->json(['success' => true, 'image' => Storage::url($path)]);
    }

    /**
     * Update the pet's full_name (rescuer or pet name) via AJAX from admin view.
     */
    public function updateName(Request $request, $id)
    {
        if (session('role') !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate(['full_name' => 'required|string|max:255']);

        $pet = Rescue::find($id);
        if (!$pet) return response()->json(['success' => false, 'message' => 'Pet not found'], 404);

        $pet->update(['full_name' => $request->input('full_name')]);

        return response()->json(['success' => true, 'full_name' => $pet->full_name]);
    }

    /**
     * Update the separate pet name field.
     */
    public function updatePetName(Request $request, $id)
    {
        if (session('role') !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate(['pet_name' => 'required|string|max:255']);

        $pet = Rescue::find($id);
        if (!$pet) return response()->json(['success' => false, 'message' => 'Pet not found'], 404);

        $pet->update(['pet_name' => $request->input('pet_name')]);

        return response()->json(['success' => true, 'pet_name' => $pet->pet_name]);
    }
}
