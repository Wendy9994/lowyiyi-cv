<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;

class AwardController extends Controller
{
    public function index()
    {
        return view('admin.awards.index', [
            'awards' => Award::all()
        ]);
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function stoer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_received' => 'required|date',
            'description' => 'required',
        ]);

        Award::create($request->all());

        return redirect()->route('awards.index')->with('success', 'Award added successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $request->validate([
            'name' => 'required',
            'date_received' => 'required|date',
            'description' => 'required',
        ]);

        $award->update($request->all());

        return redirect()->route('awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        $award->delete();
        return redirect()->route('awards.index')->with('success', 'Award deleted successfully.');
    }

    public function view($id)
    {
        $award = Award::findOrFail($id); // Fetch skill by ID
        return view('admin.awards.view', compact('award'));
    }
}
