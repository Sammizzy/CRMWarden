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

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0">
            <h3 class="mb-4">WardenCRM</h3>
            <nav>
                <a href="{{route('home') }}">Dashboard</a>
                <a href="{{route ('tasks.index')}}">My tasks</a>
                <a href="{{route ('lists.index') }}">My lists</a>
                <a href="{{route('logout') }}">Logout</a>
            </nav>
        </div>


    <form action="{{ route('tasks.store')}}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="hidden" name="list_id" value="{{ $list_id }}">

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category:</label>
            <input type="text"  name="category" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description:</label>
            <input type="text" name="description"  class="form-control" required>
        </div>

        <div class="mb-3">
            <label>status:</label>
            <input type="text" name="status"  class="form-control" required>
        </div>

        <div class="mb-3">
            <label>priority:</label>
            <input type="text" name="priority"  class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Assigned to:</label>
            <input type="text" name="assigned_to"  class="form-control" required>
        </div>

            <input value="{{$list_id}}" type="hidden" name="list_id"  class="form-control" required>

        <button class="btn btn-primary" >Submit</button>

    </form>




</x-layout>

