<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rescue;

class AdminAdoptionController extends Controller
{
    public function index()
    {
        // Admin view: load all rescues so admin can manage statuses
        $pets = Rescue::orderBy('created_at', 'desc')->get();
        return view('admin-adoption', compact('pets'));
    }
}
