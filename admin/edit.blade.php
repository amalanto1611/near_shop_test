
<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Shop</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('shops.update', $shop->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name of shop</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $shop->name }}" required>
            </div>
            <div class="form-group">
                <label for="name">type of shop</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $shop->type }}"required>
            </div>
            <div class="form-group">
                <label for="name">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $shop->latitude }}" required>
            </div> <div class="form-group">
                <label for="name">longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $shop->longitude }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>


