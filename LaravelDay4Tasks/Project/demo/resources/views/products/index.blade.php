<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-bootstrap-Css></x-bootstrap-Css>

    <title>ALL Products</title>
</head>

<body>
<x-navbar></x-navbar>
    <h1 style="text-align: center;color:red"> All Products Page</h1>
    <a href="{{route('products.create')}}">
    <x-button class="info" content="Add Products"></x-button>

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
                Price
            </th>
            <th>
                Quantity
            </th>
            <th>
                Category
            </th>
            <th>
                Action
            </th>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    {{$product["id"] }}
                </td>
                <td>
                    {{$product["name"] }}
                </td>
                <td>
                    {{$product["description"] }}
                </td>
                <td>
                    {{$product["price"] }}
                </td>
                <td>
                    {{$product["quantity"] }}
                </td>
                <td>
                    <a href="{{ route('categories.show',$product->category->id) }}">{{$product->category->name}}</a>
                </td>
                <td class="d-flex justify-content-around">
                    <div>
                        <a href="{{ route('products.show',$product["id"] ) }}" style="text-decoration:none"><button
                                class="btn btn-warning">View</button></a>
                    </div>
                     <form action="{{ route('products.edit',$product["id"])}}" method="get">

                        <button class="btn btn-primary">Edit</button>
                    </form>

                    <form action="{{ route('products.destroy',$product["id"] ) }}" method="post">
                        @csrf
                        @method('delete')

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
