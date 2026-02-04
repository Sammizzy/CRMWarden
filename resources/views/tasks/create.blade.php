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
                <a href="{{ route('home') }}">Dashboard</a>
                <a href="{{ route('tasks.index') }}">My tasks</a>
                <a href="{{ route('lists.index') }}">My lists</a>
                <a href="{{ route('logout') }}">Logout</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main flex-grow-1">
            <h2>Create Task</h2>

            <form action="{{ route('tasks.store') }}" method="POST">
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

                <!-- Hidden list ID -->
                <input type="hidden" name="list_id" value="{{ $list_id }}">

                <!-- Task Name -->
                <div class="mb-3">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category" class="form-select" id="category-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                        <option value="new">Add new category</option>
                    </select>

                    <input type="text"
                           name="new_category"
                           id="new-category-input"
                           class="form-control mt-2 d-none"
                           placeholder="New category name">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label>Description:</label>
                    <input type="text" name="description" class="form-control" required>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label>Status:</label>
                    <input type="text" name="status" class="form-control" required value="WIP">
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label>Priority:</label>
                    <input type="number" name="priority" class="form-control" required value="1">
                </div>

                <!-- Assigned To -->
                <div class="mb-3">
                    <label>Assigned To:</label>
                    <input type="text" name="assigned_to" class="form-control" required>
                </div>

                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        const categorySelect = document.getElementById('category-select');
        const newCategoryInput = document.getElementById('new-category-input');

        categorySelect.addEventListener('change', function () {
            if (this.value === 'new') {
                newCategoryInput.classList.remove('d-none');
                newCategoryInput.required = true;
            } else {
                newCategoryInput.classList.add('d-none');
                newCategoryInput.required = false;
            }
        });
    </script>

</x-layout>
