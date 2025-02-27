@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Add Education</h2>
    <form method="POST" action="{{ route('education.store') }}">
        @csrf    

        <div class="mb-3">
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Degree</label>
            <input type="text" name="degree" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>CGPA</label>
            <input type="text" name="cgpa" class="form-control">
        </div>

        <div class="mb-3">
            <label>Start Year</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Year</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('education.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
