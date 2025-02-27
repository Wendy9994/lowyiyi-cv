<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;

class ReferenceController extends Controller
{
    public function index()
    {
        return view('admin.references.index', [
            'references' => Reference::all()
        ]);
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

        Reference::create($request->all());

        return redirect()->route('references.index')->with('success', 'Reference added successfully.');
    }

    public function edit(Reference $reference)
    {
        return view('admin.references.edit', compact('reference'));
    }

    public function update(Request $request, Reference $reference)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        $reference->update($request->all());

        return redirect()->route('references.index')->with('success', 'Reference updated successfully.');
    }

    public function destroy(Reference $reference)
    {
        $reference->delete();
        return redirect()->route('references.index')->with('success', 'Reference deleted successfully.');
    }

    public function view($id)
    {
        $reference = Reference::findOrFail($id); // Fetch skill by ID
        return view('admin.references.view', compact('reference'));
    }
}
