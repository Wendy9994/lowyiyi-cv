@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Awards & Honors</h2>
    <a href="{{ route('awards.create') }}" class="btn btn-success mb-3">Add New Award</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date Received</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($awards as $award)
                <tr>
                    <td>{{ $award->name }}</td>
                    <td>{{ $award->date_received }}</td>
                    <td>{{ $award->description }}</td>
                    <td>
                        <a href="{{ route('awards.edit', $award->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('awards.destroy', $award->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this award?')">Delete</button>
                        </form>
                        <a href="{{ route('awards.view', $award->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
