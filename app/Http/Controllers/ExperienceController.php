<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::all()
        ]);
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {

    $request->validate([
        'title' => 'required',
        'type' => 'required',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
    ]);

    Experience::create($request->all());

    return redirect()->route('experiences.index')->with('success', 'Experience added successfully.');
    }


    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {

    $request->validate([
        'title' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
    ]);

    $experience->update($request->all());

    return redirect()->route('experiences.index')->with('success', 'Experience updated successfully.');
    }


    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully.');
    }

    public function view($id)
    {
        $experience = Experience::findOrFail($id); // Fetch skill by ID
        return view('admin.experiences.view', compact('experience'));
    }
}
