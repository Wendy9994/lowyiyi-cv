@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Work Experience</h2>
    <form method="POST" action="{{ route('experiences.update', $experience->id) }}">
        @csrf 
        <input type="hidden" name="_method" value="PUT">
        
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $experience->title }}" required>
        </div>
        <div class="mb-3">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ $experience->type }}" required>
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $experience->start_date }}" required>
        </div>
        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $experience->end_date }}">
        </div>
        <button type="submit" class="btn btn-success">Update Experience</button>
        <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
