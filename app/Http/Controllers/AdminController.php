<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Award;
use App\Models\Skill;
use App\Models\Reference;
use App\Models\Language;

class AdminController extends Controller
{
    // Show Admin Login Page (Redirect if already logged in)
    public function login()
    {
        if (session()->has('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Admin Authentication
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session(['admin' => true, 'admin_id' => $user->id]); // Store user ID
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['message' => 'Invalid login details.']);
    }

    // Admin Dashboard (Session Check)
    public function dashboard()
    {
        if (!session()->has('admin')) {
            return redirect('/admin')->withErrors(['message' => 'Please log in first.']);
        }

        // Fetch profile data from the database
        $profile = Profile::first() ?? new Profile([
            'name' => 'Not Available',
            'email' => 'Not Available',
            'phone' => 'Not Available',
            'location' => 'Not Available',
            'profile' => 'No Profile Information Available',
        ]);

        return view('admin.dashboard', [
            'profile' => $profile,
            'education' => Education::all(),
            'experience' => Experience::all(),
            'awards' => Award::all(),
            'skills' => Skill::all(),
            'references' => Reference::all(),
            'languages' => Language::all(),
        ]);
    }

    // Admin Logout
    public function logout()
    {
        session()->forget('admin'); // Remove admin session
        session()->flush(); // Clear all session data
        return redirect('/admin')->with('success', 'Logged out successfully.');
    }       
}
