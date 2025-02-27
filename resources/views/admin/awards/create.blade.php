@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Add Award</h2>
    <form method="POST" action="{{ route('awards.store') }}">
        @csrf

        <div class="mb-3">
            <label>Award Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date Received</label>
            <input type="date" name="date_received" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('awards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
