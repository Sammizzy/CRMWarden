<x-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register | My App</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light d-flex align-items-center" style="height:100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Create an Account</h3>

                        {{-- Display validation or session errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        placeholder="Enter your name"
                                        value="{{ old('name') }}"
                                        required
                                        autofocus
                                >
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    placeholder="Enter a username"
                                    value="{{ old('username') }}"
                                    required
                                    autofocus

                                >
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}"
                                        required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Enter password"
                                        required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm password"
                                        required
                                >
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Register</button>
                                <a href="{{ route('home') }}"></a>
                            </div>

                        </form>

                        <p class="text-center mt-3">
                            Already have an account?
                            <a href="{{ route('login') }}">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

</x-layout>

