<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show register view
    public function showRegister()
    {
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:student,instructor',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // ✅ سجل المستخدم في السيشن باستخدام Laravel Auth
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect حسب الدور
        if ($user->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }
        return redirect()->route('student.courses');
    }

    // Show login view
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'instructor') {
                return redirect()->route('instructor.dashboard');
            }
            return redirect()->route('student.courses');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}