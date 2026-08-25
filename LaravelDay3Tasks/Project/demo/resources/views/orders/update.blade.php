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
<h1 class="text-info text-center"> Update Order #{{ $order["id"] }}</h1>
<form class="w-75 m-auto border border-1 p-5" action="{{ route('orders.update',$order["id"])}}" method="post">
@method('put')
@csrf

  <div class="mb-3">
       @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
    <label for="order_user" class="form-label">User</label>
    <select class="form-control" name="user_id" id="order_user">
        <option value="">-- Select User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>


    <x-bootstrap-js></x-bootstrap-js>

</body>
</html>
