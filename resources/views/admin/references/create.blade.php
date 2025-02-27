@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Add Reference</h2>
    <form method="POST" action="{{ route('references.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('references.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
