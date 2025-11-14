<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rescue;
use App\Models\Adoption;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdminAdoptionController extends Controller
{
    public function index()
    {
        // Admin view: load all rescues with eager-loaded adoptions to avoid N+1 queries
        $pets = Rescue::with('adoptions')->orderBy('created_at', 'desc')->get();
        
        // Map pending adoptions by rescue ID for quick lookup in views
        $pendingAdoptionsByRescueId = [];
        foreach ($pets as $pet) {
            $pendingAdoptions = $pet->adoptions->filter(fn($adoption) => $adoption->adopted_at === null);
            if ($pendingAdoptions->count() > 0) {
                $pendingAdoptionsByRescueId[$pet->id] = $pendingAdoptions;
            }
        }
        
        return view('admin-adoption', compact('pets', 'pendingAdoptionsByRescueId'));
    }

    /**
     * Cancel pending adoption(s) for a given rescue id.
     * This removes adoption rows where adopted_at is null and resets rescue status if appropriate.
     */
    public function cancel($id)
    {
        $rescue = Rescue::find($id);
        if (! $rescue) {
            return response()->json(['success' => false, 'message' => 'Rescue not found'], 404);
        }

        // Wrap in transaction to ensure consistent state
        DB::beginTransaction();
        try {
            $pending = Adoption::where('rescue_id', $rescue->id)->whereNull('adopted_at');
            $count = $pending->count();
            if ($count === 0) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'No pending adoption requests found'], 400);
            }

            // Delete pending adoption requests
            $pending->delete();

            // If the rescue is not already adopted, reset status to Ready for Adoption
            if (strtolower($rescue->status ?? '') !== 'adopted') {
                $rescue->status = 'Ready for Adoption';
                $rescue->save();
            }

            DB::commit();

            // Reload the rescue with adoptions for returning updated card HTML
            $rescue->load('adoptions');
            $pet = $rescue;
            $html = view('partials.admin.pet-card', compact('pet'))->render();

            return response()->json([
                'success' => true,
                'message' => 'Pending adoption(s) canceled',
                'count' => $count,
                'status' => $rescue->status,
                'html' => $html
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return response()->json(['success' => false, 'message' => 'Failed to cancel pending adoptions'], 500);
        }
    }
}
