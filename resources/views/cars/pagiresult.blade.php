<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 8 Ajax Pagination Example - MyWebTuts.com</title>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->price }}</td>
                                <td>{{ $value->details }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $products->render() !!}
            </div>
        </div>
    </div>
</body>
</html>