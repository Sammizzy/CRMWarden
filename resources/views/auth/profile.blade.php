<x-layout>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WardenCRM Profile</title>
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

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0">
            <h3 class="mb-4">WardenCRM</h3>
            <nav>
                <a href="{{ route('home') }}">Dashboard</a>
                <a href="{{ route('tasks.index') }}">My tasks</a>
                <a href="{{ route('lists.index') }}">My lists</a>
                <a href="{{ route('logout') }}">Logout</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main flex-grow-1">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Welcome, {{ auth()->user()->username }}</h2>
                <span class="text-muted">{{ now()->format('F j, Y') }}</span>
            </div>


            @forelse($lists as $list)
                <h3 class="card p-3 mb-4 shadow-sm">{{ $list->name }}</h3>
                <p><strong>Category:</strong> {{ $list->category }}</p>
                <p><strong>Description:</strong> {{ $list->description }}</p>

                {{-- WIP Tasks --}}
                <h5 class="mt-3">WIP Tasks</h5>
                @php
                    $wipTasks = $list->tasks->where('status', '!=', 'Completed');
                @endphp

                @if($wipTasks->isEmpty())
                    <p>No WIP tasks.</p>
                @else
                    <ul class="list-group mb-3">
                        @foreach($wipTasks as $task)
                            <li class="list-group-item">
                                {{ $task->name }} — Assigned to: {{ $task->assigned_to ?? 'Unassigned' }}
                                <span class="badge bg-warning float-end">{{ $task->status }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- Completed Tasks --}}
                <h5>Completed Tasks</h5>
                @php
                    $completedTasks = $list->tasks->where('status', 'Completed');
                @endphp


                @if($completedTasks->isEmpty())
                    <p>No completed tasks.</p>
                @else
                    <ul class="list-group mb-4">
                        @foreach($completedTasks as $task)
                            <li class="list-group-item" style="background-color: #d4edda;">
                                {{ $task->name }} — Assigned to: {{ $task->assigned_to ?? 'Unassigned' }}
                                <span class="badge bg-success float-end">{{ $task->status }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{--edit/delete buttons--}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('lists.edit', $list->id) }}" class="btn btn-warning btn-sm w-25 me-1">Edit</a>
                    <form action="{{ route('lists.destroy', $list->id) }}" method="POST" class="w-25 ms-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Delete this list?')">Delete</button>
                    </form>
                </div>

            @empty
                <p>You have no lists yet.</p>
            @endforelse

        </div>
    </div>
    </body>
    </html>

</x-layout>















