@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Award Details</h2>

    <div class="mb-3">
        <label><strong>Award Name:</strong></label>
        <p>{{ $award->name }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Date Received:</strong></label>
        <p>{{ $award->date_received }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Description:</strong></label>
        <p>{{ $award->description }}</p> <!-- Fixed issue here -->
    </div>

    <a href="{{ route('awards.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
