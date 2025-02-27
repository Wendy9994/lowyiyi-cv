<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class SkillController extends Controller
{
    private $firestore;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->firestore = $factory->createFirestore()->database();
    }

    public function index()
    {
        $skillsRef = $this->firestore->collection('skills')->documents();
        $skills = [];

        foreach ($skillsRef as $doc) {
            $skills[] = array_merge(['id' => $doc->id()], $doc->data());
        }

        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'proficiency' => 'required|integer|min:1|max:100',
        ]);

        $this->firestore->collection('skills')->add([
            'category' => $request->category,
            'name' => $request->name,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit($id)
    {
        $doc = $this->firestore->collection('skills')->document($id)->snapshot();

        if (!$doc->exists()) {
            return redirect()->route('skills.index')->with('error', 'Skill not found.');
        }

        $skill = array_merge(['id' => $doc->id()], $doc->data());

        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'proficiency' => 'required|integer|min:1|max:100',
        ]);

        $this->firestore->collection('skills')->document($id)->set([
            'category' => $request->category,
            'name' => $request->name,
            'proficiency' => $request->proficiency,
        ], ['merge' => true]);

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy($id)
    {
        $this->firestore->collection('skills')->document($id)->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }

    public function view($id)
    {
        $doc = $this->firestore->collection('skills')->document($id)->snapshot();

        if (!$doc->exists()) {
            return redirect()->route('skills.index')->with('error', 'Skill not found.');
        }

        $skill = array_merge(['id' => $doc->id()], $doc->data());

        return view('admin.skills.view', compact('skill'));
    }
}
