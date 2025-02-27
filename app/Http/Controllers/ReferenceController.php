<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ReferenceController extends Controller
{
    private $firestore;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->firestore = $factory->createFirestore()->database();
    }

    public function index()
    {
        $referencesRef = $this->firestore->collection('references')->documents();
        $references = [];

        foreach ($referencesRef as $doc) {
            $references[] = array_merge(['id' => $doc->id()], $doc->data());
        }

        return view('admin.references.index', compact('references'));
    }

    public function create()
    {
        return view('admin.references.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        $this->firestore->collection('references')->add([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
        ]);

        return redirect()->route('references.index')->with('success', 'Reference added successfully.');
    }

    public function edit($id)
    {
        $doc = $this->firestore->collection('references')->document($id)->snapshot();

        if (!$doc->exists()) {
            return redirect()->route('references.index')->with('error', 'Reference not found.');
        }

        $reference = array_merge(['id' => $doc->id()], $doc->data());

        return view('admin.references.edit', compact('reference'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        $this->firestore->collection('references')->document($id)->set([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
        ], ['merge' => true]); // Merging to avoid overwriting fields

        return redirect()->route('references.index')->with('success', 'Reference updated successfully.');
    }

    public function destroy($id)
    {
        $this->firestore->collection('references')->document($id)->delete();
        return redirect()->route('references.index')->with('success', 'Reference deleted successfully.');
    }

    public function view($id)
    {
        $doc = $this->firestore->collection('references')->document($id)->snapshot();

        if (!$doc->exists()) {
            return redirect()->route('references.index')->with('error', 'Reference not found.');
        }

        $reference = array_merge(['id' => $doc->id()], $doc->data());

        return view('admin.references.view', compact('reference'));
    }
}
