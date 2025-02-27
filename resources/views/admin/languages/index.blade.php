@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Languages</h2>
    <a href="{{ route('languages.create') }}" class="btn btn-success mb-3">Add New Language</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Language</th>
                <th>Proficiency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($languages as $language)
                <tr>
                    <td>{{ $language->name }}</td>
                    <td>{{ $language->proficiency }}</td>
                    <td>
                        <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('languages.destroy', $language->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this language?')">Delete</button>
                        </form>
                        <a href="{{ route('languages.view', $language->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
