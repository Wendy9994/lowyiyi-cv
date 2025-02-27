@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Reference</h2>
    <form method="POST" action="{{ route('references.update', $reference->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $reference->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $reference->email }}" required>
        </div>
        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" value="{{ $reference->position }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Reference</button>
        <a href="{{ route('references.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
