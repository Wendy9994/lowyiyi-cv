@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Reference Details</h2>

    <div class="mb-3">
        <label><strong>Name:</strong></label>
        <p>{{ $reference->name }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Email:</strong></label>
        <p>{{ $reference->email }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Position:</strong></label>
        <p>{{ $reference->position }}</p>
    </div>

    <a href="{{ route('references.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
