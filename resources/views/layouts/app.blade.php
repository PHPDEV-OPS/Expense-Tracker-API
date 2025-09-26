<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Expense Tracker</a>
            <div class="d-flex ms-auto">
                @if(Auth::check())
                    <span class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    <a href="/register" class="btn btn-primary btn-sm">Register</a>
                @endif
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
