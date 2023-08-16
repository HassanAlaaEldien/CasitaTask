// Add markers to Google Maps based on city.
var map, InfoWindow = null;

// Initialize Map Function
function initialize() {
    var options = {
        zoom: 2.6,
        center: (new google.maps.LatLng(50, 25)),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map"), options);
}

// Adds a marker to the map.
function addPin(message, map) {
    let url = "http://maps.google.com/mapfiles/ms/icons/" + message.pin_color + "-dot.png";

    var marker = new google.maps.Marker({
        position: message.location,
        map: map,
        title: message.name,
        icon: {
            url: url,
            scaledSize: new google.maps.Size(38, 38)
        }
    });

    // Message based on the city.
    var InfoWindow = new google.maps.InfoWindow({
        content: '<span> Mesasge: ' + message.message + '</span> <br> <span> Sentiment: ' + message.category + '</span>'
    });

    // Show the message.
    google.maps.event.addListener(marker, 'click', function () {
        InfoWindow.open(map, marker);
    });
}

function getMessages() {
    let params = (new URL(document.location)).searchParams;
    let type = params.get("type");
    let formSubmitUrl = document.getElementById("map").getAttribute('data-url') + (type ? ('?type=' + type) : '');
    axios.get(formSubmitUrl).then(function (response) {
        // Loop through messages and add pins.
        response.data.data.messages.forEach(function (message) {
            addPin(message, map)
        })
    })
}

// Initialize Map
initialize();

// List messages on the map
getMessages();
