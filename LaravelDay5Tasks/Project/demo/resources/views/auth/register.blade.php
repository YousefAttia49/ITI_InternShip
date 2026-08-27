<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <x-bootstrap-css></x-bootstrap-css>

</head>

<body>
    <x-navbar></x-navbar>
    <h1 class="text-success text-center"> Register</h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('register.submit') }}" method="post">
        @csrf

        <div class="mb-3">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="register_name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="register_name">
        </div>
        <div class="mb-3">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="register_email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="register_email">
        </div>
        <div class="mb-3">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="register_password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="register_password">
        </div>
        <div class="mb-3">
            <label for="register_password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="register_password_confirmation">
        </div>

        <button type="submit" class="btn btn-success">Register</button>
        <a href="{{ route('login') }}" class="btn btn-link">Already have an account? Login</a>
    </form>


    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
