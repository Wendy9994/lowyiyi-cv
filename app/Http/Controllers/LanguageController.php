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

        Language::create([
            'name' => $request->name,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language added successfully.');
    }

    public function edit($id)
    {
        $language = Language::where('_id', $id)->firstOrFail();
        return view('admin.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'proficiency' => 'required|in:Beginner,Intermediate,Advanced,Fluent,Native',
        ]);

        $language = Language::where('_id', $id)->firstOrFail();
        $language->update([
            'name' => $request->name,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy($id)
    {
        Language::where('_id', $id)->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully.');
    }

    public function view($id)
    {
        $language = Language::where('_id', $id)->firstOrFail();
        return view('admin.languages.view', compact('language'));
    }
}
