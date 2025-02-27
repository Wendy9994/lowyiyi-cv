@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Skill Details</h2>

    <div class="mb-3">
        <label><strong>Category:</strong></label>
        <p>{{ $skill->category }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Skill Name:</strong></label>
        <p>{{ $skill->name }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Proficiency:</strong></label>
        <p>{{ $skill->proficiency }}%</p>
    </div>

    <a href="{{ route('skills.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
