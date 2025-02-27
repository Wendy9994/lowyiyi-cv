@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Language Details</h2>

    <div class="mb-3">
        <label><strong>Language Name:</strong></label>
        <p>{{ $language->name }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Proficiency Level:</strong></label>
        <p>{{ $language->proficiency }}</p>
    </div>

    <a href="{{ route('languages.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
