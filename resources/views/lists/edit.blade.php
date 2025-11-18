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
            </body>
            </html>



        <h2>Edit List</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lists.update', $list->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" value="{{ old('name', $list->name) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Category:</label>
                <input type="text" name="category" value="{{ old('category', $list->category) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description:</label>
                <input type="text" name="description" value="{{ old('description', $list->description) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Priority:</label>
                <input type="text" name="priority" value="{{ old('priority', $list->priority) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Status:</label>
                <input type="text" name="status" value="{{ old('status', $list->status) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Assigned to:</label>
                <input type="text" name="assigned_to" value="{{ old('assigned_to', $list->assigned_to) }}" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </x-layout>

