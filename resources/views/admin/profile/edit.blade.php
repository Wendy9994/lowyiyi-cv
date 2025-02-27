@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $profile->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $profile->email }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $profile->phone }}" required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $profile->location }}" required>
        </div>
        <div class="mb-3">
            <label>Objective</label>
            <textarea name="profile" class="form-control" required>{{ $profile->profile }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Profile</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        <a href="{{ route('profile.view', ['id' => $profile->id]) }}" class="btn btn-info">View</a>
    </form>
</div>
@endsection
