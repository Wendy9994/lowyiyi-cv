@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Education</h2>
    <form method="POST" action="{{ route('education.update', $education->id) }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        
        <div class="mb-3">
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" value="{{ $education->institution }}" required>
        </div>
        <div class="mb-3">
            <label>Degree</label>
            <input type="text" name="degree" class="form-control" value="{{ $education->degree }}" required>
        </div>
        <div class="mb-3">
            <label>CGPA</label>
            <input type="text" name="cgpa" class="form-control" value="{{ $education->cgpa }}">
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $education->start_date }}" required>
        </div>
        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $education->end_date }}">
        </div>
        <button type="submit" class="btn btn-success">Update Education</button>
        <a href="{{ route('education.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
