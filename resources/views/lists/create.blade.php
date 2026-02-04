<x-layout>
    <div class="d-flex">

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
                <h2>Welcome, {{ Auth::user()->name }}</h2>
                <span class="text-muted">{{ now()->format('F j, Y') }}</span>
            </div>

            <h2>Create List</h2>

            <form action="{{ route('lists.store') }}" method="POST">
                @csrf

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- List Name -->
                <div class="mb-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category-select">Category</label>
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
                           placeholder="Enter new category name">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <input type="text" name="description" class="form-control" id="description" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- JS to toggle new category input -->
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
