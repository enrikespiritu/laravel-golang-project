<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticket Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="mb-4">Welcome!</h1>

                <h4 class="mb-1">Branches</h4>
                            
                <a href="{{ route('city-a') }}" class="btn btn-primary">City A</a>
                <a href="{{ route('city-b') }}" class="btn btn-primary">City B</a>
                <a href="{{ route('city-c') }}" class="btn btn-primary">City C</a>
                <a href="{{ route('city-d') }}" class="btn btn-primary">City D</a>
                <a href="{{ route('city-e') }}" class="btn btn-primary">City E</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <a href="{{ route('admin') }}" class="btn btn-primary">Admin Page</a>
            </div>
        </div>

    </div>
</body>
</html>
