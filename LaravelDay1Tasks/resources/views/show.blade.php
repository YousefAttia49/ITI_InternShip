<!DOCTYPE html>
<html>

<head>

    <title>User Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">

            User Details

        </div>

        <div class="card-body">

            <h3>{{ $user['name'] }}</h3>

            <hr>

            <h5>Email :</h5>

            <p>{{ $user['email'] }}</p>

            <h5>Age :</h5>

            <p>{{ $user['age'] }}</p>

            <a href="{{ route('users.index') }}"
               class="btn btn-primary">

                Back

            </a>

        </div>

    </div>

</div>

</body>

</html>