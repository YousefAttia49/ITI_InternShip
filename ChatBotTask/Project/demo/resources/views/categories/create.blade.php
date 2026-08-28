<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
    <x-bootstrap-css></x-bootstrap-css>

</head>

<body>
    <x-navbar></x-navbar>
    <h1 class="text-success text-center"> Create New Category</h1>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('categories.store') }}" method="post">
        @csrf

        <div class="mb-3">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="category_name">
        </div>
        <div class="mb-3">
            @error('descripyion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="category_description" class="form-label">Category Description</label>
            <input type="text" class="form-control" name="descripyion" id="category_description">
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>


    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
