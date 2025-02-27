@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h2>Profile Details</h2>

    <div class="mb-3">
        <label><strong>Name:</strong></label>
        <p>{{ $profile->name }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Email:</strong></label>
        <p>{{ $profile->email }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Phone:</strong></label>
        <p>{{ $profile->phone }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Location:</strong></label>
        <p>{{ $profile->location }}</p>
    </div>

    <div class="mb-3">
        <label><strong>Objective:</strong></label>
        <p>{{ $profile->profile }}</p>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
