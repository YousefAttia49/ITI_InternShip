<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <x-bootstrap-css></x-bootstrap-css>

</head>

<body>
    <x-navbar></x-navbar>
    <h1 class="text-success text-center"> Login</h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('login.submit') }}" method="post">
        @csrf

        <div class="mb-3">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="login_email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="login_email">
        </div>
        <div class="mb-3">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="login_password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="login_password">
        </div>

        <button type="submit" class="btn btn-success">Login</button>
        <a href="{{ route('register') }}" class="btn btn-link">Don't have an account? Register</a>
    </form>


    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
