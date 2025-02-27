<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class AwardController extends Controller
{
    protected $database;
    protected $awardRef;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->database = $factory->createDatabase();
        $this->awardRef = $this->database->getReference('awards'); // Reference to "awards" collection
    }

    public function index()
    {
        $awards = $this->awardRef->getValue() ?? []; // Get all awards
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_received' => 'required|date',
            'description' => 'required',
        ]);

        $newAward = [
            'name' => $request->input('name'),
            'date_received' => $request->input('date_received'),
            'description' => $request->input('description'),
            'created_at' => now()->toDateTimeString()
        ];

        $this->awardRef->push($newAward); // Firebase push()

        return redirect()->route('awards.index')->with('success', 'Award added successfully.');
    }

    public function edit($id)
    {
        $award = $this->awardRef->getChild($id)->getValue(); // Fetch award by ID
        return view('admin.awards.edit', compact('award', 'id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'date_received' => 'required|date',
            'description' => 'required',
        ]);

        $updatedAward = [
            'name' => $request->input('name'),
            'date_received' => $request->input('date_received'),
            'description' => $request->input('description'),
            'updated_at' => now()->toDateTimeString()
        ];

        $this->awardRef->getChild($id)->update($updatedAward); // Update award in Firebase

        return redirect()->route('awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy($id)
    {
        $this->awardRef->getChild($id)->remove(); // Delete award in Firebase
        return redirect()->route('awards.index')->with('success', 'Award deleted successfully.');
    }

    public function view($id)
    {
        $award = $this->awardRef->getChild($id)->getValue(); // Get award by ID
        return view('admin.awards.view', compact('award'));
    }
}
