@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Add Language</h2>
    <form method="POST" action="{{ route('languages.store') }}">
        @csrf

        <div class="mb-3">
            <label>Language Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Proficiency Level</label>
            <select name="proficiency" class="form-control">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
                <option value="Fluent">Fluent</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('languages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
