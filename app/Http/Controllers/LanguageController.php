<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        return view('admin.languages.index', [
            'languages' => Language::all()
        ]);
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

        Language::create($request->all());

        return redirect()->route('languages.index')->with('success', 'Language added successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required',
            'proficiency' => 'required|in:Beginner,Intermediate,Advanced,Fluent,Native',
        ]);
        
        $language->update($request->all());

        return redirect()->route('languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully.');
    }

    public function view($id)
    {
        $language = Language::findOrFail($id); // Fetch skill by ID
        return view('admin.languages.view', compact('language'));
    }
}
