@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Award</h2>
    <form method="POST" action="{{ route('awards.update', $award->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Award Name</label>
            <input type="text" name="name" class="form-control" value="{{ $award->name }}" required>
        </div>
        <div class="mb-3">
            <label>Date Received</label>
            <input type="date" name="date_received" class="form-control" value="{{ $award->date_received }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $award->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Award</button>
        <a href="{{ route('awards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
