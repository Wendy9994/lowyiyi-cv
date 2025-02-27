<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ExperienceController extends Controller
{
    private $firestore;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->firestore = $factory->createFirestore()->database();
    }

    public function index()
    {
        $experiences = $this->firestore->collection('experiences')->documents();
        return view('admin.experiences.index', compact('experiences'));
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

        $this->firestore->collection('experiences')->add([
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
        $experience = $this->firestore->collection('experiences')->document($id)->snapshot();

        if (!$experience->exists()) {
            return redirect()->route('experiences.index')->with('error', 'Experience not found.');
        }

        return view('admin.experiences.edit', ['experience' => $experience->data(), 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $experienceRef = $this->firestore->collection('experiences')->document($id);
        $experienceRef->set([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ], ['merge' => true]);

        return redirect()->route('experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy($id)
    {
        $this->firestore->collection('experiences')->document($id)->delete();
        return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully.');
    }

    public function view($id)
    {
        $experience = $this->firestore->collection('experiences')->document($id)->snapshot();

        if (!$experience->exists()) {
            return redirect()->route('experiences.index')->with('error', 'Experience not found.');
        }

        return view('admin.experiences.view', ['experience' => $experience->data()]);
    }
}
