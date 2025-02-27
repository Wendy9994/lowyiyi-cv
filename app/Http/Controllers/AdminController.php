<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class AdminController extends Controller
{
    protected $database;
    protected $adminRef;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->database = $factory->createDatabase();
        $this->adminRef = $this->database->getReference('admins'); // Firebase "admins" node
    }

    // Show Admin Login Page
    public function login()
    {
        if (session()->has('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Admin Authentication (Login)
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admins = $this->adminRef->getValue() ?? [];

        if (!$admins) {
            return back()->withErrors(['message' => 'Invalid login details.']);
        }

        foreach ($admins as $id => $admin) {
            if (isset($admin['username'], $admin['password']) &&
                $admin['username'] === $credentials['username'] &&
                Hash::check($credentials['password'], $admin['password'])) {
                
                session([
                    'admin' => $admin, 
                    'admin_id' => $id
                ]);

                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors(['message' => 'Invalid login details.']);
    }

    // Admin Dashboard
    public function dashboard()
    {
        if (!session()->has('admin')) {
            return redirect('/admin')->withErrors(['message' => 'Please log in first.']);
        }

        $adminId = session('admin_id');
        $profile = $this->adminRef->getChild($adminId)->getValue();

        if (!$profile) {
            return redirect('/admin')->withErrors(['message' => 'Admin profile not found.']);
        }

        return view('admin.dashboard', compact('profile'));
    }

    // Admin Logout
    public function logout()
    {
        session()->flush();
        return redirect('/admin')->with('success', 'Logged out successfully.');
    }

    // Show Admin Registration Page
    public function register()
    {
        if (session()->has('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.register');
    }

    // Store New Admin in Firebase
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        // Check if username already exists
        $admins = $this->adminRef->getValue() ?? [];

        foreach ($admins as $admin) {
            if (isset($admin['username']) && $admin['username'] === $request->username) {
                return back()->withErrors(['message' => 'Username already exists.']);
            }
        }

        $newAdmin = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        $this->adminRef->push($newAdmin); // Add admin to Firebase

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully. Please log in.');
    }
}
