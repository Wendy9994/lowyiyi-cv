@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Add Skill</h2>
    <form method="POST" action="{{ route('skills.store') }}">
        @csrf

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Skill Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Proficiency (%)</label>
            <input type="number" name="proficiency" class="form-control" min="1" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('skills.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
