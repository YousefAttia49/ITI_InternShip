<!DOCTYPE html>
<html>

<head>

    <title>Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Users</h2>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Email</th>

            <th>Age</th>

            <th>Action</th>

        </tr>

        @foreach($users as $user)

        <tr>

            <td>{{ $user['id'] }}</td>

            <td>{{ $user['name'] }}</td>

            <td>{{ $user['email'] }}</td>

            <td>{{ $user['age'] }}</td>

            <td>

                <a href="{{ route('users.show',$user['id']) }}"
                   class="btn btn-success">

                    Show

                </a>

            </td>

        </tr>

        @endforeach

    </table>

</div>

</body>

</html>