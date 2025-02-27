@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Experience Details</h2>

    <div class="mb-3">
        <label><strong>Title:</strong></label>
        <p>{{ $experience->title }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Type:</strong></label>
        <p>{{ $experience->type }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Start Date:</strong></label>
        <p>{{ $experience->start_date }}</p>
    </div>

    <div class="mb-3">
        <label><strong>End Date:</strong></label>
        <p>{{ $experience->end_date }}</p>
    </div>

    <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
