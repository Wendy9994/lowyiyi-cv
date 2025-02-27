<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class LanguageController extends Controller
{
    private $firestore;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->firestore = $factory->createFirestore()->database();
    }

    public function index()
    {
        $languages = $this->firestore->collection('languages')->documents();
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'proficiency' => 'required|in:Beginner,Intermediate,Advanced,Fluent,Native',
        ]);

        $this->firestore->collection('languages')->add([
            'name' => $request->name,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language added successfully.');
    }

    public function edit($id)
    {
        $language = $this->firestore->collection('languages')->document($id)->snapshot();

        if (!$language->exists()) {
            return redirect()->route('languages.index')->with('error', 'Language not found.');
        }

        return view('admin.languages.edit', ['language' => $language->data(), 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'proficiency' => 'required|in:Beginner,Intermediate,Advanced,Fluent,Native',
        ]);

        $languageRef = $this->firestore->collection('languages')->document($id);
        $languageRef->set([
            'name' => $request->name,
            'proficiency' => $request->proficiency,
        ], ['merge' => true]);

        return redirect()->route('languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy($id)
    {
        $this->firestore->collection('languages')->document($id)->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully.');
    }

    public function view($id)
    {
        $language = $this->firestore->collection('languages')->document($id)->snapshot();

        if (!$language->exists()) {
            return redirect()->route('languages.index')->with('error', 'Language not found.');
        }

        return view('admin.languages.view', ['language' => $language->data()]);
    }
}
