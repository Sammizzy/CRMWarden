<x-layout>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>WardenCRM Dashboard</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>

            <div class="d-flex">
                <!-- Sidebar -->
                <div class="sidebar flex-shrink-0">
                    <h3 class="mb-4">WardenCRM</h3>
                    <nav>
                        <a href="{{ route('profile') }}">Profile</a>
                        <a href="{{ route('logout') }}">Logout</a>

                    </nav>
                </div>

                <!-- Main content -->
                <div class="main flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Welcome, {{ Auth::user()->username }}</h2>
                        <span class="text-muted">{{ now()->format('F j, Y') }}</span>
                    </div>

                    <!-- Quick stats / cards -->
{{--                    these should be made in to buttons which take you to serpate pages containing expanded views of each--}}
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card p-3">
                                <h5>Total Clients</h5>
                                <p class="fs-4">24</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3">
                                <h5>Active Projects</h5>
                                <p class="fs-4">8</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3">
                                <h5>Pending Tasks</h5>
                                <p class="fs-4">15</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent activity table -->
                    <div class="mt-5">
                        <h4>Recent Activity</h4>
                        <table class="table table-hover mt-3">
                            <thead>
                            <tr>
                                <th>Task</th>
                                <th>Assigned To</th>
                                <th>Status</th>
                                <th>Due Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Follow up with client</td>
                                <td>John Doe</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>Oct 20, 2025</td>
                            </tr>
                            <tr>
                                <td>Website redesign</td>
                                <td>Jane Smith</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>Oct 10, 2025</td>
                            </tr>
                            <tr>
                                <td>CRM data cleanup</td>
                                <td>Emily Johnson</td>
                                <td><span class="badge bg-primary">In Progress</span></td>
                                <td>Oct 18, 2025</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </body>
            </html>




</x-layout>

