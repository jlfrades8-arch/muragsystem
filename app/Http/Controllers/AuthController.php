<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session; 
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
        $email = $request->input('email'); 
        $password = $request->input('password');
         // Simple hardcoded credentials for demo only 
        if ($email === 'admin@gmail.com' && $password === 'admin123') {
             session(['role' => 'admin', 'user_email' => $email]);
             return redirect()->route('dashboard');
             } elseif ($email === 'user@gmail.com' && $password === 'user123') {
             session(['role' => 'user', 'user_email' => $email]);
              return redirect()->route('dashboard'); 
            } else { return back()->with('error', 'Invalid credentials');
         }
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
         // Fake registration (no DB) 
        return redirect()->route('login')->with('success', 'User registered successfully!');
     }
      // ===== HANDLE REGISTER ADMIN ===== 
     public function registerAdmin(Request $request) 
     {
         // Fake registration (no DB) 
        return redirect()->route('login')->with('success', 'Admin registered successfully!');
     }
      // ===== DASHBOARD ===== 
     public function showDashboard()
     { $role = session('role');
         if ($role === 'admin') { return view('admin-dashboard'); 
        } elseif ($role === 'user') { return view('user-dashboard'); 
        } else { return redirect()->route('login');
        }
     } // ===== LOGOUT ===== 
     public function logout() 
     { Session::flush();
         return redirect()->route('login')->with('success', 'You have logged out.'); 
        }
     }