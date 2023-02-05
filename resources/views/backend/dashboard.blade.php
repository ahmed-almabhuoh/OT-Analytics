{{-- @extends('backend.layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
    
@endsection

@section('content')
    <div id="viewDiv"></div>
@endsection

@section('scripts')

@endsection --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,
        body,
        #viewDiv {
            padding: 0;
            margin: 0;
            height: 90vh;
            width: 100%;
            margin: 15px auto;
        }
    </style>

    <link rel="stylesheet" href="https://js.arcgis.com/4.25/esri/themes/light/main.css">
    <script src="https://js.arcgis.com/4.25/"></script>

    <script>
        require(["esri/config", "esri/Map", "esri/views/MapView"], function(esriConfig, Map, MapView) {

            esriConfig.apiKey = "5efc00eea6da49299ad8d1e7f6ed203f";

            const map = new Map({
                basemap: "arcgis-imagery" // Basemap layer service
            });

            const view = new MapView({
                map: map,
                center: [-118.805, 34.027], // Longitude, latitude
                zoom: 13, // Zoom level
                container: "viewDiv" // Div element
            });

        });
    </script>
</head>

<body>
    <div id="viewDiv"></div>
</body>

</html>
