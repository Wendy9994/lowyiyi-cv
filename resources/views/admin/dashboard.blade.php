@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>
    <p>Welcome, Admin! Manage your CV data here.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Profile</h5>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Education</h5>
                <a href="{{ route('education.index') }}" class="btn btn-primary">Manage Education</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Experience</h5>
                <a href="{{ route('experiences.index') }}" class="btn btn-primary">Manage Experience</a>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h5>Awards</h5>
                <a href="{{ route('awards.index') }}" class="btn btn-primary">Manage Awards</a>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h5>Skills</h5>
                <a href="{{ route('skills.index') }}" class="btn btn-primary">Manage Skills</a>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h5>Languages</h5>
                <a href="{{ route('languages.index') }}" class="btn btn-primary">Manage Languages</a>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h5>References</h5>
                <a href="{{ route('references.index') }}" class="btn btn-primary">Manage References</a>
            </div>
        </div>
    </div>
</div>
@endsection
