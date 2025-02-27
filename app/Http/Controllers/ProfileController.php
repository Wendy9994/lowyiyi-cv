<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Award;
use App\Models\Skill;
use App\Models\Reference;
use App\Models\Language;

class ProfileController extends Controller
{
    // Public CV Page
    public function index()
    {
        return view('cv', [
            'profile' => Profile::first(),
            'education' => Education::all(),
            'experience' => Experience::all(),
            'awards' => Award::all(),
            'skills' => Skill::all(),
            'references' => Reference::all(),
            'languages' => Language::all(),
        ]);
    }

    // Show Edit Form
    public function edit()
    {
        $profile = Profile::first();
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

        $profile = Profile::first();
        $profile->update($request->all());

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function view($id)
    {
        $profile = Profile::findOrFail($id); // Fetch skill by ID
        return view('admin.profile.view', compact('profile'));
    }
}
