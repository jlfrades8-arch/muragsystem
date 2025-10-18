<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rescue;
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

        return redirect()->route('dashboard');
    }
     // ===== REGISTER SELECT PAGE =====
     public function showRegisterSelect()       
     {
         return view('register');
     }
      // ===== REGISTER FOR USER ===== 
     public function showRegisterUser() 
     {
         return view('register-user');
     }
      // ===== REGISTER FOR ADMIN ===== 
     public function showRegisterAdmin() 
     {
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
            $pets = Rescue::orderBy('created_at', 'desc')->get();
            return view('admin-dashboard', compact('pets'));
        } elseif ($role === 'user') {
            // Show adoption list as the main user dashboard (pets ready for adoption)
            $pets = Rescue::where('status', 'Ready for Adoption')->orderBy('created_at', 'desc')->get();
            return view('user-adoption', compact('pets'));
        } else {
            return redirect()->route('login');
        }
    }

    // ===== LOGOUT ===== 
     public function logout() 
     { Session::flush();
         return redirect()->route('login')->with('success', 'You have logged out.'); 
        }
     }