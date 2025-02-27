@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Work Experience</h2>
    <a href="{{ route('experiences.create') }}" class="btn btn-success mb-3">Add New Experience</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($experiences as $exp)
                <tr>
                    <td>{{ $exp->title }}</td>
                    <td>{{ $exp->type }}</td>
                    <td>{{ $exp->start_date }}</td>
                    <td>
                        <a href="{{ route('experiences.edit', $exp->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('experiences.destroy', $exp->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                        <a href="{{ route('experiences.view', $exp->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
