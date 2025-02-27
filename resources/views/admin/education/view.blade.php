@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Education Details</h2>

    <div class="mb-3">
        <label><strong>Institution:</strong></label>
        <p>{{ $education->institution }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Degree:</strong></label>
        <p>{{ $education->degree }}</p>
    </div>

    <div class="mb-3">
        <label><strong>CGPA:</strong></label>
        <p>{{ $education->cgpa }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Start Date:</strong></label>
        <p>{{ $education->start_date }}</p>
    </div>

    <div class="mb-3">
        <label><strong>End Date:</strong></label>
        <p>{{ $education->end_date }}</p>
    </div>

    <a href="{{ route('education.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
