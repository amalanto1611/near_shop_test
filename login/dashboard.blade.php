<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    .add-vendor-button {
        background-color: #1E90FF; /* Green background */
        border: none;
        color: white;
        padding: 15px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
    }

    .add-vendor-button:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    /* Position the button to the top right corner */
    .add-vendor-button-container {
        position: reative;
        top: 10px; /* Adjust as needed */
        right: 10px; /* Adjust as needed */
    }
</style>
</head>
<body>

@extends('layout.app')



@section('content')
    

<div class="container">
    <h1>Shops</h1>
    <div>
                Logged in as: <strong>{{ Auth::user()->role }}</strong>
            </div><br>
            <!-- resources/views/shops/index.blade.php -->

<form action="{{ route('shops.search') }}" method="GET" class="mt-3">
    <div class="form-row">
        <div class="col">
            <input type="text" name="latitude" class="form-control" placeholder="Latitude" required>
        </div>
        <div class="col">
            <input type="text" name="longitude" class="form-control" placeholder="Longitude" required>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<br>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(Auth::user()->role == 'admin')
    <a href="{{ route('shops.create') }}" class="btn btn-primary">Create Shop</a>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                @if(Auth::user()->role == 'admin')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->type }}</td>
                    <td>{{ $shop->latitude }}</td>
                    <td>{{ $shop->longitude }}</td>
                    <td>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('shops.edit', ['id' => $shop->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('shops.delete', ['id' => $shop->id]) }}" class="btn btn-danger">Delete</a>
                        <!-- <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> -->
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- resources/views/shops/search.blade.php -->


<div class="container">
    <h1>Nearest Shops</h1>
    <div id="map" style="height: 500px;"></div>
    <script>
        
        var map = L.map('map').setView([{{ $shops->first()->latitude }}, {{ $shops->first()->longitude }}], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        @foreach($shops as $shop)
            L.marker([{{  $shops->first()->latitude  }}, {{ $shops->first()->longitude}}]).addTo(map)
                .bindPopup('<b>{{ $shop->name }}</b>').openPopup();

                
        @endforeach
    </script>
</div>


@endsection
</body>
</html>
