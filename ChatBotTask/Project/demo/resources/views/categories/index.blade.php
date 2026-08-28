<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>ALL Categories</title>
</head>

<body>
<x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> All Categories Page</h1>
    {{-- @dump($students) --}}
    {{-- <x-button class="primary" content="Login" /> --}}
    <a href="{{route('categories.create')}}">
    <x-button class="info" content="Add Categories"></x-button>

    </a>
    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>
                id
            </th>
            <th>
                Name
            </th>
            <th>
                Description
            </th>
            <th>
                Action
            </th>
        </thead>
        <tbody>
            @foreach($categories as $category)
            {{-- @dump($student) --}}
            <tr>
                <td>
                    {{$category["id"] }}
                </td>
                <td>
                    {{$category["name"] }}
                </td>
                <td>
                    {{$category["description"] }}
                </td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{ route('categories.show',$category["id"] ) }}" style="text-decoration:none"><button
                                class="btn btn-warning">View</button></a>
                    </div>
                     <form action="{{ route('categories.edit',$category["id"])}}" method="get">

                        <button class="btn btn-primary">Edit</button>
                    </form>

                    <form action="{{ route('categories.destroy',$category["id"] ) }}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger">Delete</button>

                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>

    </table>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
</body>

</html>
