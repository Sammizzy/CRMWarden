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

        <!-- Main content -->
        <div class="main flex-grow-1">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{--                <h2>Welcome, {{ Auth::user()->username }}</h2>--}}
                <span class="text-muted">{{ now()->format('F j, Y') }}</span>
            </div>


            <h2 class="mb-4">{{ $list->name }}</h2>

            {{-- List summary --}}
            <div class="card p-3 mb-4 shadow-sm">
                <p><strong>Category:</strong> {{ $list->category }}</p>
                <p><strong>Description:</strong> {{ $list->description }}</p>
                <p><strong>Priority:</strong> {{ $list->priority }}</p>
                <p><strong>Status:</strong> {{ $list->status }}</p>
                {{--            unsure whether to keep feature of assigned list--}}
                <p><strong>Assigned To:</strong> {{ $list->assigned_to ?? 'Unassigned' }}</p>
            </div>

            <a href="{{ route('tasks.create', $list->id) }}" class="btn btn-success mb-3">
                + Create Task for this List
            </a>

            <hr>

            <h3>WIP Tasks</h3>
            @if($list->tasks->where('status', '!=', 'Completed')->isEmpty())
                <p>No tasks in progress.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Assigned</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list->tasks->where('status', '!=', 'Completed') as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->assigned_to }}</td>
                            <td>
                                <a href="{{ route('tasks.complete', $task->id) }}" class="btn btn-success btn-sm">Complete</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            <hr>
            {{--     Displays all tasks where status == completed       --}}
            <h3>Completed Tasks</h3>
            @if($list->tasks->where('status', 'Completed')->isEmpty())
                <p>No completed tasks.</p>
            @else
                <table class="table table-success">
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Assigned</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list->tasks->where('status', 'Completed') as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->assigned_to }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
    @endif
</x-layout>



