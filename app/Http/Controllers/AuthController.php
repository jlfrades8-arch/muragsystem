<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rescue;
use App\Models\Adoption;
use App\Models\Setting;

class AuthController extends Controller
{
    // ===== SHOW LOGIN PAGE ===== 
    public function showLogin()
    {
        return view('login');
    }
    // ===== HANDLE LOGIN ===== 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        // store minimal session info (this app uses session for simple auth)
        session(['role' => $user->role, 'user_email' => $user->email, 'user_id' => $user->id]);

        // Ensure admins land on the admin dashboard first
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        // Regular users go to the user dashboard
        return redirect()->route('dashboard');
    }
    // ===== REGISTER SELECT PAGE =====
    public function showRegisterSelect()
    {
        return view('register-select');
    }
    // ===== REGISTER FOR USER ===== 
    public function showRegisterUser()
    {
        return view('register-user');
    }
    // ===== REGISTER FOR ADMIN ===== 
    public function showRegisterAdmin()
    {
        // Check if admin registration is allowed
        $adminRegistrationEnabled = Setting::get('admin_registration_enabled', '1') == '1';
        if (!$adminRegistrationEnabled) {
            return redirect()->route('register')->with('error', 'Admin registration is currently disabled.');
        }
        return view('register-admin');
    }
    // ===== HANDLE REGISTER USER ===== 
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully!');
    }
    // ===== HANDLE REGISTER ADMIN ===== 
    public function registerAdmin(Request $request)
    {
        // Check if admin registration is allowed
        $adminRegistrationEnabled = Setting::get('admin_registration_enabled', '1') == '1';
        if (!$adminRegistrationEnabled) {
            return redirect()->route('register')->with('error', 'Admin registration is currently disabled.');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'admin',
        ]);

        return redirect()->route('login')->with('success', 'Admin registered successfully!');
    }
    // ===== DASHBOARD ===== 
    public function showDashboard()
    {
        $role = session('role');
        if ($role === 'admin') {
            // Eager-load adoptions to avoid N+1 queries
            $pets = Rescue::with('adoptions')->orderBy('created_at', 'desc')->get();
            
            // Compute pending count and map pending adoptions to each rescue
            $pendingCount = 0;
            $pendingAdoptionsByRescueId = [];
            
            foreach ($pets as $pet) {
                // Pending adoptions are those with null adopted_at
                $pendingAdoptions = $pet->adoptions->filter(fn($adoption) => $adoption->adopted_at === null);
                if ($pendingAdoptions->count() > 0) {
                    $pendingCount += $pendingAdoptions->count();
                    $pendingAdoptionsByRescueId[$pet->id] = $pendingAdoptions;
                }
            }
            
            return view('admin-dashboard', compact('pets', 'pendingCount', 'pendingAdoptionsByRescueId'));
        } elseif ($role === 'user') {
            // Show adoption list as the main user dashboard (pets ready for adoption)
            // Eager-load adoptions for pending check
            $pets = Rescue::with('adoptions')
                ->where('status', 'Ready for Adoption')
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Map pending adoptions for quick lookup in views
            $pendingAdoptionsByRescueId = [];
            foreach ($pets as $pet) {
                $pendingAdoptions = $pet->adoptions->filter(fn($adoption) => $adoption->adopted_at === null);
                if ($pendingAdoptions->count() > 0) {
                    $pendingAdoptionsByRescueId[$pet->id] = $pendingAdoptions;
                }
            }

            // Get user's adoptions count
            $userEmail = session('user_email');
            $adoptionsCount = Adoption::where('adopter_email', $userEmail)->count();

            return view('user-dashboard', compact('pets', 'adoptionsCount', 'pendingAdoptionsByRescueId'));
        } else {
            return redirect()->route('login');
        }
    }

    // ===== LOGOUT ===== 
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'You have logged out.');
    }

    // ===== PROFILE PAGE =====
    public function showProfile()
    {
        $user = User::where('email', session('user_email'))->first();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return view('profile', compact('user'));
    }

    // ===== ADMIN SETTINGS PAGE =====
    public function showAdminSettings()
    {
        // Only admins can access settings
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $adminRegistrationEnabled = Setting::get('admin_registration_enabled', '1') == '1';
        return view('admin-settings', compact('adminRegistrationEnabled'));
    }

    // ===== UPDATE ADMIN SETTINGS =====
    public function updateAdminSettings(Request $request)
    {
        // Only admins can update settings
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $adminRegistrationEnabled = $request->has('admin_registration_enabled') ? '1' : '0';
        Setting::set('admin_registration_enabled', $adminRegistrationEnabled);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }
}
