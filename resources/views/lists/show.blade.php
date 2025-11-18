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

        <h2 class="mb-4">List: {{ $list->name }}</h2>

        {{-- List summary --}}
        <div class="card p-3 mb-4 shadow-sm">
            <p><strong>Category:</strong> {{ $list->category }}</p>
            <p><strong>Description:</strong> {{ $list->description }}</p>
            <p><strong>Priority:</strong> {{ $list->priority }}</p>
            <p><strong>Status:</strong> {{ $list->status }}</p>
            <p><strong>Assigned To:</strong> {{ $list->assigned_to ?? 'Unassigned' }}</p>
        </div>

        <a href="{{ route('tasks.create', ['list_id' => $list->id]) }}" class="btn btn-success mb-3">
            + Create Task for this List
        </a>

        <hr>

        <h3>Tasks for this List</h3>

        @if($list->tasks->isEmpty())
            <p>No tasks yet for this list.</p>
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
                @foreach($list->tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->assigned_to }}</td>

                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this task?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </x-layout>



<