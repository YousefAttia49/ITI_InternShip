<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-bootstrap-css></x-bootstrap-css>

</head>
<body>
<x-navbar></x-navbar>
<h1 class="text-info text-center"> Update {{ $user["name"] }}</h1>
<form class="w-75 m-auto border border-1 p-5" action="{{ route('users.update',$user["id"])}}" method="post">
@method('put')
@csrf

  <div class="mb-3">
       @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
    <label for="user_name" class="form-label">User Name</label>
    <input type="text" class="form-control"  name="name" id="user_name" value="{{ $user['name'] }}">
  </div>
  <div class="mb-3">
       @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
    <label for="user_email" class="form-label">User Email</label>
    <input type="email" class="form-control" name="email" id="user_email" value="{{ $user['email'] }}">
  </div>
  <div class="mb-3">
       @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
    <label for="user_password" class="form-label">User Password</label>
    <input type="password" class="form-control" name="password" id="user_password">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>


    <x-bootstrap-js></x-bootstrap-js>

</body>
</html>
