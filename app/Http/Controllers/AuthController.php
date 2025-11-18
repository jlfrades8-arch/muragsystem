<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rescue;
use App\Models\Adoption;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

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

        // Clear any leftover password-reset / dashboard verification flags from previous flows
        session()->forget(['requires_dashboard_code', 'post_reset_token', 'post_reset_email', 'dashboard_code_hash', 'dashboard_code_created_at']);

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
        // If a password-reset flow is active and requires a one-time code, redirect to verification page
        // Do not require code for a normal login session.
        $requiresCode = session('requires_dashboard_code');
        $hasResetContext = session()->has('post_reset_token') || session()->has('post_reset_email') || session()->has('dashboard_code_hash');
        if ($requiresCode && $hasResetContext) {
            return redirect()->route('dashboard.verify');
        }

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

    // ===== SHOW DASHBOARD VERIFICATION FORM =====
        public function showDashboardVerify()
        {
            // If not signed in, go to login
            if (!session('user_email')) {
                return redirect()->route('login');
            }

            return view('dashboard-verify-code');
        }

        // ===== HANDLE DASHBOARD VERIFICATION =====
        public function postDashboardVerify(Request $request)
        {
            $request->validate([
                'code' => 'required|string|size:6',
            ]);

            $email = session('user_email');

            // First, check session-stored dashboard code (preferred for link flow)
            $valid = false;
            if (session()->has('dashboard_code_hash')) {
                $hash = session('dashboard_code_hash');
                $created = session('dashboard_code_created_at');
                if (Hash::check($request->code, $hash)) {
                    if (now()->diffInHours($created) > 24) {
                        return back()->with('error', 'The code has expired.');
                    }
                    $valid = true;
                }
            }

            // Fallback: check DB records if session does not have dashboard code
            if (!$valid) {
                $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($record) {
                    if (Schema::hasColumn('password_reset_tokens', 'method')) {
                        if (in_array($record->method, ['dashboard', 'post_reset', 'otp'])) {
                            if (Hash::check($request->code, $record->token)) {
                                if (now()->diffInHours($record->created_at) > 24) {
                                    return back()->with('error', 'The code has expired.');
                                }
                                $valid = true;
                            }
                        }
                    } else {
                        if (Hash::check($request->code, $record->token)) {
                            if (now()->diffInHours($record->created_at) > 24) {
                                return back()->with('error', 'The code has expired.');
                            }
                            $valid = true;
                        }
                    }
                }
            }

            if (!$valid) {
                return back()->with('error', 'Invalid code.');
            }

            // Success: remove session-stored dashboard code if present, else delete DB dashboard entry
            if (session()->has('dashboard_code_hash')) {
                session()->forget('dashboard_code_hash');
                session()->forget('dashboard_code_created_at');
            } else {
                if (Schema::hasColumn('password_reset_tokens', 'method')) {
                    DB::table('password_reset_tokens')->where('email', $email)->where('method', 'dashboard')->delete();
                } else {
                    DB::table('password_reset_tokens')->where('email', $email)->delete();
                }
            }

            // Clear requirement and redirect to change-password page with stored token
            session()->forget('requires_dashboard_code');
            $token = session('post_reset_token');
            $emailParam = session('post_reset_email');
            // clear temporary session values
            session()->forget('post_reset_token');
            session()->forget('post_reset_email');

            return redirect()->route('password.reset', ['token' => $token, 'email' => $emailParam]);
        }

    // ===== LOGOUT ===== 
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'You have logged out.');
    }

    // ===== SHOW FORGOT PASSWORD =====
    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'We could not find a user with that email address.');
        }

        // Delete old tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Generate reset token
        $token = Str::random(60);
        $insert = [
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ];

        if (Schema::hasColumn('password_reset_tokens', 'method')) {
            $insert['method'] = 'link';
        }

        DB::table('password_reset_tokens')->insert($insert);

        // Generate reset URL
        $resetUrl = route('password.reset', ['token' => $token]) . '?email=' . urlencode($request->email);

        // Send email with link
        try {
            Mail::send('emails.password-reset', ['resetUrl' => $resetUrl], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Reset Your Password - Pet Adoption System');
            });

            return back()->with('status', 'We have emailed your password reset link! Please check your email inbox or spam folder.');
        } catch (\Exception $e) {
            // If email fails, still show the link for development
            return back()->with('status', 'Password reset link generated. In development mode, check your log file or use this link: ' . $resetUrl);
        }
    }

    // ===== SHOW RESET PASSWORD =====
    public function showResetPassword(Request $request, $token)
    {
        return view('reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // ===== RESET PASSWORD =====
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->with('error', 'Invalid or expired reset token.');
        }

        // Ensure token matches (works for both link tokens and OTP codes)
        if (!Hash::check($request->token, $resetRecord->token)) {
            return back()->with('error', 'Invalid reset token.');
        }

        // Check if token is expired (24 hours)
        if (now()->diffInHours($resetRecord->created_at) > 24) {
            return back()->with('error', 'Reset token has expired.');
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->update(['password' => Hash::make($request->password)]);

        // Delete token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password has been reset successfully! Please login with your new password.');
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

    // ===== UPDATE PROFILE =====
    public function updateProfile(Request $request)
    {
        $user = User::where('email', session('user_email'))->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => ['nullable', 'string', 'regex:/^(09|\+639)\d{9}$/'],
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
        ]);

        // Update session if email changed
        if ($request->email !== session('user_email')) {
            session(['user_email' => $request->email]);
        }

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
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
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'Unauthorized access.'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Handle toggle from dropdown button
        if ($request->has('toggle')) {
            $currentValue = Setting::get('admin_registration_enabled', '1');
            $newValue = $currentValue == '1' ? '0' : '1';
            Setting::set('admin_registration_enabled', $newValue);

            return response()->json(['success' => true, 'enabled' => $newValue == '1']);
        }

        // Handle form submission (legacy for admin-settings page)
        $adminRegistrationEnabled = $request->has('admin_registration_enabled') ? '1' : '0';
        Setting::set('admin_registration_enabled', $adminRegistrationEnabled);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }

    // ===== UPLOAD PROFILE PICTURE =====
    public function uploadProfilePicture(Request $request)
    {
        $user = User::where('email', session('user_email'))->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store new picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');

        // Update user
        $user->update(['profile_picture' => $path]);

        return redirect()->route('profile')->with('success', 'Profile picture updated successfully!');
    }

    // ===== DELETE PROFILE PICTURE =====
    public function deleteProfilePicture(Request $request)
    {
        $user = User::where('email', session('user_email'))->first();

        if (!$user) {
            return redirect()->route('login');
        }

        // Delete file if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Clear profile picture field
        $user->update(['profile_picture' => null]);

        return redirect()->route('profile')->with('success', 'Profile picture removed successfully!');
    }

    // ===== SHOW ALL USERS (ADMIN ONLY) =====
    public function showUsers()
    {
        // Only admins can access user list
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Get only regular users (exclude admins)
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();

        return view('admin-users', compact('users'));
    }

    // ===== SHOW USER PROFILE (ADMIN ONLY) =====
    public function showUserProfile($id)
    {
        // Only admins can access user profiles
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $user = User::find($id);

        if (!$user || $user->role !== 'user') {
            return redirect()->route('admin.users')->with('error', 'User not found.');
        }

        // Get user's adoptions
        $adoptions = Adoption::where('adopter_email', $user->email)->orderBy('created_at', 'desc')->get();

        return view('admin-user-profile', compact('user', 'adoptions'));
    }

    // ===== DELETE USER (ADMIN ONLY) =====
    public function destroyUser($id)
    {
        // Only admins can delete users
        if (session('role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $user = User::find($id);

        if (!$user || $user->role !== 'user') {
            return redirect()->route('admin.users')->with('error', 'User not found or cannot be deleted.');
        }

        // Prevent deleting the currently logged-in admin by accident
        if ($user->id === session('user_id')) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        // (Audit log removed) Proceed to delete user

        // Remove profile picture file if present
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Optionally remove adoptions tied to this user (by email)
        Adoption::where('adopter_email', $user->email)->delete();

        // Finally delete the user
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
