<x-layout>

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

    <a href="{{ route('lists.create') }}" class="btn btn-success mb-3">Create new list</a>
    <table class="table">
        <thead>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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

    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Assigned</th>
    </tr>

    <tbody>
    @foreach($lists as $item)
        <tr>
{{--        {{dd()}}--}}
            <td>{{ $item->name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->priority }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->assigned_to }}</td>


            <td>
                <a href="{{ route('lists.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('lists.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this item?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

            </body>
            </html>
</x-layout>

