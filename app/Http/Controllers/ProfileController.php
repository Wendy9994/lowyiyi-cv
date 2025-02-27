<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ProfileController extends Controller
{
    private $firestore;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->firestore = $factory->createFirestore()->database();
    }

    // Public CV Page
    public function index()
    {
        $profile = $this->firestore->collection('profile')->documents()->rows()[0] ?? null;
        $education = $this->firestore->collection('education')->documents();
        $experience = $this->firestore->collection('experience')->documents();
        $awards = $this->firestore->collection('awards')->documents();
        $skills = $this->firestore->collection('skills')->documents();
        $references = $this->firestore->collection('references')->documents();
        $languages = $this->firestore->collection('languages')->documents();

        return view('cv', compact('profile', 'education', 'experience', 'awards', 'skills', 'references', 'languages'));
    }

    // Show Edit Form
    public function edit()
    {
        $profile = $this->firestore->collection('profile')->documents()->rows()[0] ?? null;
        return view('admin.profile.edit', compact('profile'));
    }

    // Update Profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
            'profile' => 'required',
        ]);

        $profileRef = $this->firestore->collection('profile')->documents()->rows()[0] ?? null;

        if ($profileRef) {
            $this->firestore->collection('profile')->document($profileRef->id())->set([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'profile' => $request->profile,
            ], ['merge' => true]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function view($id)
    {
        $profile = $this->firestore->collection('profile')->document($id)->snapshot();

        if (!$profile->exists()) {
            return redirect()->route('profile.edit')->with('error', 'Profile not found.');
        }

        return view('admin.profile.view', ['profile' => $profile->data()]);
    }
}
