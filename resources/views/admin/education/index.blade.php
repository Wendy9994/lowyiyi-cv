@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Education Records</h2>
    <a href="{{ route('education.create') }}" class="btn btn-success mb-3">Add New Education</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Institution</th>
                <th>Degree</th>
                <th>CGPA</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($education as $edu)
                <tr>
                    <td>{{ $edu->institution }}</td>
                    <td>{{ $edu->degree }}</td>
                    <td>{{ $edu->cgpa }}</td>
                    <td>{{ $edu->start_date }}</td>
                    <td>{{ $edu->end_date }}</td>
                    <td>
                        <a href="{{ route('education.edit', $edu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('education.destroy', $edu->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this $education?')">Delete</button>
                        </form>
                        <a href="{{ route('education.view', $edu->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
