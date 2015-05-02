function doSomethingWithGeo(geo) {
    var currentLocation=[];
    console.log(currentLocation);
    return currentLocation;
}

function get_location() {
    navigator.geolocation.getCurrentPosition(function (position) {
        doSomethingWithGeo([[position.coords.latitude, position.coords.longitude]]);
    });
}