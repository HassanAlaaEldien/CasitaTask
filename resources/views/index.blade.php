<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Casita Task</title>
</head>
<body>
<div id="map" data-url="{{ route('messages.index') }}" style="height: 600px; width: 100%"></div>

<div>
    <ul>
        <li>
            <span>
                <img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" alt="">
                <img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png" alt="">
                <img src="http://maps.google.com/mapfiles/ms/icons/orange-dot.png" alt="">
                <a href="/">List All Messages ( Click on the marker to view message )</a>.
            </span>
        </li>
    </ul>
    <ul>
        <li>
            <span>
                <img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" alt="">
                Red Marker Refers To <a href="?type=Negative">Negative</a> Messages.
            </span>
        </li>
        <li>
            <span>
                <img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png" alt="">
                Green Marker Refers To <a href="?type=Positive">Positive</a> Messages.
            </span>
        </li>
        <li>
            <span>
                <img src="http://maps.google.com/mapfiles/ms/icons/orange-dot.png" alt="">
                Orange Marker Refers To <a href="?type=Neutrual">Neutrual</a> Messages.
            </span>
        </li>
    </ul>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBryTvNGhaWT-HHy7wN8yaRhZoxAlfRG1Y"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/js/map.js') }}"></script>
</body>
</html>
