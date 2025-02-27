<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class EducationController extends Controller
{
    protected $database;
    protected $educationRef;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->database = $factory->createDatabase();
        $this->educationRef = $this->database->getReference('education'); // Reference to "education" collection
    }

    public function index()
    {
        $education = $this->educationRef->getValue() ?? []; // Get all education records
        return view('admin.education.index', compact('education'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'institution' => 'required',
            'degree' => 'required',
            'cgpa' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Create new education record
        $newEducation = [
            'institution' => $request->input('institution'),
            'degree' => $request->input('degree'),
            'cgpa' => $request->input('cgpa'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'created_at' => now()->toDateTimeString()
        ];

        $this->educationRef->push($newEducation); // Firebase push()

        return redirect()->route('education.index')->with('success', 'Education added successfully.');
    }

    public function edit($id)
    {
        $education = $this->educationRef->getChild($id)->getValue(); // Fetch education by ID
        return view('admin.education.edit', compact('education', 'id'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'cgpa' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Updated education record
        $updatedEducation = [
            'institution' => $request->input('institution'),
            'degree' => $request->input('degree'),
            'cgpa' => $request->input('cgpa'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'updated_at' => now()->toDateTimeString()
        ];

        $this->educationRef->getChild($id)->update($updatedEducation); // Update in Firebase

        return redirect()->route('education.index')->with('success', 'Education updated successfully!');
    }

    public function destroy($id)
    {
        $this->educationRef->getChild($id)->remove(); // Delete from Firebase
        return redirect()->route('education.index')->with('success', 'Education deleted successfully.');
    }

    public function view($id)
    {
        $education = $this->educationRef->getChild($id)->getValue(); // Get education by ID
        return view('admin.education.view', compact('education'));
    }
}
