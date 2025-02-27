@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Add Work Experience</h2>
    <form method="POST" action="{{ route('experiences.store') }}">
        @csrf

        <div class="mb-3">
            <label>Job Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
