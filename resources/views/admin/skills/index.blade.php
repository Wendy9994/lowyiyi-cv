@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Skills</h2>
    <a href="{{ route('skills.create') }}" class="btn btn-success mb-3">Add New Skill</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Skill</th>
                <th>Proficiency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
                <tr>
                    <td>{{ $skill->category }}</td>
                    <td>{{ $skill->name }}</td>
                    <td>{{ $skill->proficiency }}%</td>
                    <td>
                        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                        <a href="{{ route('skills.view', $skill->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
