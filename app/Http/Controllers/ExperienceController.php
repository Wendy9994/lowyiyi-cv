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

        Experience::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('experiences.index')->with('success', 'Experience added successfully.');
    }

    public function edit($id)
    {
        $experience = Experience::where('_id', $id)->firstOrFail();
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $experience = Experience::where('_id', $id)->firstOrFail();
        $experience->update([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy($id)
    {
        Experience::where('_id', $id)->delete();
        return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully.');
    }

    public function view($id)
    {
        $experience = Experience::where('_id', $id)->firstOrFail();
        return view('admin.experiences.view', compact('experience'));
    }
}
