@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Language</h2>
    <form method="POST" action="{{ route('languages.update', $language->id) }}">
        @csrf 
        @method('PUT')
        <div class="mb-3">
            <label>Language Name</label>
            <input type="text" name="name" class="form-control" value="{{ $language->name }}" required>
        </div>
        <div class="mb-3">
            <label>Proficiency Level</label>
            <select name="proficiency" class="form-control" required>
                <option value="Beginner" {{ $language->proficiency == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="Intermediate" {{ $language->proficiency == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="Advanced" {{ $language->proficiency == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                <option value="Fluent" {{ $language->proficiency == 'Fluent' ? 'selected' : '' }}>Fluent</option>
                <option value="Native" {{ $language->proficiency == 'Native' ? 'selected' : '' }}>Native</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Language</button>
        <a href="{{ route('languages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
