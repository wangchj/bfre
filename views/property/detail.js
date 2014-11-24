//State variables
var map;

$(function(){
    initMap();
});

function initMap() {
    
    latLng = getLatLng();
    var myOptions = {
        center: latLng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        //mapTypeControl: false,
        //panControl: false,
        //streetViewControl: false,
        //zoomControl: false
    };
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    marker = new google.maps.Marker({position:latLng, map:map});
    drawBound();
}



/**
 * Get the point location of this property.
 * @returns google.maps.LatLng lat/lon of this location.
 */
function getLatLng()
{
    return parseLatLng(pointStr);
}

/**
 * Gets the bound (polygon) of this property.
 */
function drawBound()
{
    strs = boundStr.split(',');
    a = [];
    for(i = 0; i < strs.length; i++)
        a.push(parseLatLng(strs[i]));
    polygon = new google.maps.Polygon({
        strokeColor: "#FFFF00",
        strokeOpacity: 0.5,
        strokeWeight: 1,
        fillColor: "#FFFF00",
        fillOpacity: 0.3,
        map: map,
        path:a
    });
}