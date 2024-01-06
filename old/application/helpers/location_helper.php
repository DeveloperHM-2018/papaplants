<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function geoLocate($address)
{
    try {
        $lat = 0;
        $lng = 0;
        $data_location = "https://maps.google.com/maps/api/geocode/json?key=" . $GOOGLE_API_KEY_HERE . "&address=" . str_replace(" ", "+", $address) . "&sensor=false";
        $data = file_get_contents($data_location);
        usleep(200000);
        // turn this on to see if we are being blocked
        // echo $data;
        $data = json_decode($data);
        if ($data->status == "OK") {
            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;
            if ($lat && $lng) {
                return array(
                    'status' => true,
                    'lat' => $lat,
                    'long' => $lng,
                    'google_place_id' => $data->results[0]->place_id
                );
            }
        }
        if ($data->status == 'OVER_QUERY_LIMIT') {
            return array(
                'status' => false,
                'message' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
            );
        }
    } catch (Exception $e) {
    }
    return array('lat' => null, 'long' => null, 'status' => false);
}
<script>
var x=document.getElementById("demo");
function getLocation(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
    else{
        x.innerHTML="Geolocation is not supported by this browser.";
    }
}
function showPosition(position){
    lat=position.coords.latitude;
    lon=position.coords.longitude;
    displayLocation(lat,lon);
}
function showError(error){
    switch(error.code){
        case error.PERMISSION_DENIED:
            x.innerHTML="User denied the request for Geolocation."
        break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML="Location information is unavailable."
        break;
        case error.TIMEOUT:
            x.innerHTML="The request to get user location timed out."
        break;
        case error.UNKNOWN_ERROR:
            x.innerHTML="An unknown error occurred."
        break;
    }
}
function displayLocation(latitude,longitude){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);
    geocoder.geocode(
        {'latLng': latlng},
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");
                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    x.innerHTML = "city name is: " + city;
                }
                else  {
                    x.innerHTML = "address not found";
                }
            }
            else {
                x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
}
</script>
