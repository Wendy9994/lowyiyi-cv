<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <a class="navbar-brand ms-3" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <a class="btn btn-danger me-3" href="{{ route('admin.logout') }}">Logout</a>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">Edit Profile</a>
                    <a href="{{ route('education.index') }}" class="list-group-item list-group-item-action">Education</a>
                    <a href="{{ route('experiences.index') }}" class="list-group-item list-group-item-action">Experience</a>
                    <a href="{{ route('awards.index') }}" class="list-group-item list-group-item-action">Awards</a>
                    <a href="{{ route('skills.index') }}" class="list-group-item list-group-item-action">Skills</a>
                    <a href="{{ route('languages.index') }}" class="list-group-item list-group-item-action">Languages</a>
                    <a href="{{ route('references.index') }}" class="list-group-item list-group-item-action">References</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
