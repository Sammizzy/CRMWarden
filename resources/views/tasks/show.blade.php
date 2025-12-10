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



    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0">
            <h3 class="mb-4">WardenCRM</h3>
            <nav>
                <a href="{{ route('home') }}">Dashboard</a>
                <a href="{{ route('tasks.index') }}">My Tasks</a>
                <a href="{{ route('lists.index') }}">My Lists</a>
                <a href="{{ route('logout') }}">Logout</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main flex-grow-1">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="text-muted">{{ now()->format('F j, Y') }}</span>
            </div>

            <!-- Page Title -->
            <h2 class="mb-4">{{ $task->name }}</h2>

            <!-- Task Summary -->
            <div class="card p-3 mb-4 shadow-sm"
                 style="background-color: {{ $task->color ?? '#ffffff' }};">
                <p><strong>Category:</strong> {{ $task->category }}</p>
                <p><strong>Description:</strong> {{ $task->description }}</p>
                <p><strong>Priority:</strong> {{ $task->priority }}</p>
                <p><strong>Status:</strong> {{ $task->status }}</p>
                <p><strong>Assigned To:</strong> {{ $task->assigned_to }}</p>
{{--                <p><strong>Part of List:</strong>--}}
{{--                    @if ($task->list)--}}
{{--                        <a href="{{ route('lists.show', $task->list->id) }}">--}}
{{--                            {{ $task->list->name }}--}}
{{--                        </a>--}}
{{--                    @else--}}
{{--                        <span class="text-muted">No list assigned</span>--}}
{{--                    @endif--}}
{{--                </p>--}}



            <!-- Quick actions -->
            <div class="mb-4">
                <a href="{{ route('tasks.complete', $task->id) }}" class="btn btn-success btn-sm">
                    Mark as Complete
                </a>

                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                    Edit Task
                </a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this task?')">
                        Delete
                    </button>
                </form>
            </div>

            <hr>

            <!-- Return to list -->
            <a href="{{ route('lists.show', $task->list_id) }}" class="btn btn-secondary">
                ← Back to List
            </a>
        </div>
    </div>

</x-layout>
