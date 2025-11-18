

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardenCRM Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #1f2937;
            color: #fff;
            padding: 1rem;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
        }
        .sidebar a:hover {
            background-color: #374151;
            border-radius: 4px;
        }
        .main {
            padding: 2rem;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>



<h2 class="mb-4">Lists</h2>


<div class="mb-3">
    <a href="{{ route('profile') }}" class="btn btn-secondary">Profile</a>
    <a href="{{ route('lists.create') }}" class="btn btn-success">Create New List</a>
</div>


@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


<form method="GET" action="{{ route('lists.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or category" class="form-control">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>


@if(request('search'))
    <p>Showing results for: <strong>{{ request('search') }}</strong></p>
@endif


<div class="row">
    @foreach($lists as $item)
        <div class="col-md-4">
            <div class="card mb-3 p-3 shadow-sm">

                <h4>{{ $item->name }}</h4>
                <p><strong>Category:</strong> {{ $item->category }}</p>
                <p><strong>Priority:</strong> {{ $item->priority }}</p>
                <p><strong>Status:</strong> {{ $item->status }}</p>

                <hr>

                <a href="{{ route('lists.show', $item->id) }}" class="btn btn-primary w-100 mb-2">
                    View List Details
                </a>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('lists.edit', $item->id) }}" class="btn btn-warning btn-sm w-50 me-1">Edit</a>

                    <form action="{{ route('lists.destroy', $item->id) }}" method="POST" class="w-50 ms-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Delete this list?')">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    @endforeach
</div>


