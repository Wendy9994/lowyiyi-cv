@extends('admin.layout')

@section('content')
<div class="container">
    <h2>References</h2>
    <a href="{{ route('references.create') }}" class="btn btn-success mb-3">Add New Reference</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($references as $reference)
                <tr>
                    <td>{{ $reference->name }}</td>
                    <td>{{ $reference->email }}</td>
                    <td>{{ $reference->position }}</td>
                    <td>
                        <a href="{{ route('references.edit', $reference->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('references.destroy', $reference->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this reference?')">Delete</button>
                        </form>
                        <a href="{{ route('references.view', $reference->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
