<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <title>order</title>
</head>

<body>

    <h1 style="text-align: center;color:red"> Order #{{ $order['id'] }} Page</h1>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>
                id
            </th>
            <th>
                User
            </th>
            <th>
                Created At
            </th>
            <th>
                Action
            </th>
        </thead>
        <tbody>

            <tr>
                <td>
                    {{$order["id"] }}
                </td>
                <td>
                    <a href="{{ route('users.show',$order->user->id) }}">{{$order->user->name}}</a>
                </td>
                <td>
                    {{$order["created_at"] }}
                </td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{route('orders.index') }}"><button class="btn btn-success">Back</button> </a>

                    </div>
                    <form action="{{ route('orders.edit',$order["id"])}}" method="get">

                        <button class="btn btn-primary">Edit</button>
                    </form>

                    <form action="{{ route('orders.destroy',$order["id"])}}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger">Delete</button>

                    </form>
                </td>
            </tr>


        </tbody>

    </table>
    <hr>

    <h2 class="text-center text-success"> Order Items </h2>

    <table class="table table-striped w-75 m-auto">
        <thead>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </thead>
        <tbody>
            @foreach($order->order_items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
</body>

</html>
