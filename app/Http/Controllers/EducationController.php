<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        return view('admin.education.index', [
            'education' => Education::all()
        ]);
    }

    public function create()
    {
        return view('admin.education.create');
    }

    
    public function store(Request $request)
{
    // Validate input
    $validatedData = $request->validate([
        'institution' => 'required',
        'degree' => 'required',
        'cgpa' => 'nullable|numeric',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
    ]);

    // Try saving data manually
    $education = new Education();
    $education->institution = $request->institution;
    $education->degree = $request->degree;
    $education->cgpa = $request->cgpa;
    $education->start_date = $request->start_date;
    $education->end_date = $request->end_date;
    
    $saved = $education->save(); // Save the record

    return redirect('/education')->with('success', 'Education added successfully.');

}


    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
{
    // Validate input
    $request->validate([
        'institution' => 'required|string|max:255',
        'degree' => 'required|string|max:255',
        'cgpa' => 'nullable|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    // Update the record
    $education->update([
        'institution' => $request->institution,
        'degree' => $request->degree,
        'cgpa' => $request->cgpa,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return redirect()->route('education.index')->with('success', 'Education updated successfully!');
}

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('education.index')->with('success', 'Education deleted successfully.');
    }

    public function view($id)
    {
        $education = Education::findOrFail($id); // Fetch skill by ID
        return view('admin.education.view', compact('education'));
    }
}
