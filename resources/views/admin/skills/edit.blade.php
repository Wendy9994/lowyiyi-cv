@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Skill</h2>
    <form method="POST" action="{{ route('skills.update', $skill->id) }}">
        @csrf
        @method('PUT')  <!-- Add this line -->

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" value="{{ $skill->category }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Skill Name</label>
            <input type="text" name="name" value="{{ $skill->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Proficiency (%)</label>
            <input type="number" name="proficiency" value="{{ $skill->proficiency }}" class="form-control" min="1" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Update Skill</button>
        <a href="{{ route('skills.index') }}" class="btn btn-secondary">Cancel</a>    
    </form>
</div>
@endsection
