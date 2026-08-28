<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <x-bootstrap-Css></x-bootstrap-Css>
    <title>ALL Users</title>
</head>

<body>
<x-navbar></x-navbar>
    {{-- @dump($students) --}}
    {{-- <x-button class="primary" content="Login" /> --}}
    <h1 style="text-align: center;color:red"> All Users Page</h1>
    <a href="{{route('users.create')}}">
    <x-button class="info" content="Add User"></x-button>
    </a>
    {{-- @dump($users) --}}

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>
                id
            </th>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Action
            </th>
        </thead>
        <tbody>
            @foreach($users as $user)
            {{-- @dump($user) --}}
            <tr>
                <td>
                    {{$user["id"] }}
                </td>
                <td>
                    {{$user["name"] }}
                </td>
                <td>
                    {{$user["email"] }}
                </td>
                <td class="d-flex justify-content-around">
                    <div>
                    <a href="{{ route('users.show',$user["id"]) }}" style="text-decoration:none"><button class="btn btn-warning">View</button></a>
                    </div>
                    <form action="{{ route('users.edit',$user["id"])}}" method="get">

                        <button class="btn btn-primary">Edit</button>
                    </form>

                    <form action="{{ route('users.destroy',$user["id"] ) }}" method="post">
                        @method('delete')
                        @csrf

                        <button class="btn btn-danger">Delete</button>

                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>

    </table>
   <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
