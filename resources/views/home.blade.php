@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="mb-4">Welcome to the Expense Tracker</h1>
            <p class="lead mb-4">
                This is a simple Expense Tracker application built with Laravel. You can securely register, log in, and manage your personal expenses. Track your spending by category, filter by date, and keep your finances organized!
            </p>
            <ul class="list-group mb-4 text-start mx-auto" style="max-width: 400px;">
                <li class="list-group-item">✔️ Register and log in securely</li>
                <li class="list-group-item">✔️ Add, update, and delete expenses</li>
                <li class="list-group-item">✔️ Filter expenses by date and category</li>
                <li class="list-group-item">✔️ JWT-protected API endpoints</li>
            </ul>
            <div class="alert alert-info mb-4" style="max-width: 400px; margin: 0 auto;">
                <strong>Demo User:</strong><br>
                Email: <code>test@example.com</code><br>
                Password: <code>password</code>
            </div>
            <a href="/login" class="btn btn-primary btn-lg me-2">Login</a>
            <a href="/register" class="btn btn-outline-primary btn-lg">Register</a>
        </div>
    </div>
</div>
@endsection
