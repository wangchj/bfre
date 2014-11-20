//State variables
var map;

var pointMode = 0;
var boundMode = 1;
var drawMode;

var marker = null;
var polygon = null;
var pointArray = [];

$(function(){
   initMap();
});

function initMap() {
    ///<summary>Initializes spatial tool Google map.</summary>

    var myOptions = {
        center: new google.maps.LatLng(32.606, -85.481),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        //mapTypeControl: false,
        //panControl: false,
        //streetViewControl: false,
        //zoomControl: false
    };
    map = new google.maps.Map(document.getElementById("map"),
        myOptions);

    //When updating an existing property
    if(typeof pointStr != 'undefined' && pointStr != null && pointStr != '')
    {
        latlng = parseLatLng(pointStr);
        map.setCenter(latlng);
        marker = new google.maps.Marker({position:latlng, map:map});
        $('#point').html(latlng.toUrlValue());
    }
    if(typeof boundStr != 'undefined' && boundStr != null && boundStr != '')
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
            //map: map,
        });

        polygon.setPath(a);
        polygon.setMap(map);
    }

    initMapControl();

    //Assign event handler for map click event.
    google.maps.event.addListener(map, 'click', mapClick);
}

/**
 * Map click event handler
 */
function mapClick(event)
{
    if(drawMode == pointMode)
    {
        if(marker != null)
            marker.setMap(null);
        marker = new google.maps.Marker({position:event.latLng, map:map});
        marker.setMap(map);
        $('#property-latlon').val(event.latLng.lat() + ' ' + event.latLng.lng());
        $('#point').html(event.latLng.toUrlValue()); 
    }
    else //Assume boundMode
    {
        pointArray.push(event.latLng);
        if(polygon == null)
        /*pointArray = [
            new google.maps.LatLng(32.610134,-85.483954),
            new google.maps.LatLng(32.605001,-85.477989),
            new google.maps.LatLng(32.603012,-85.486228),
            new google.maps.LatLng(32.608146,-85.491078)
        ];*/
            polygon = new google.maps.Polygon({
                strokeColor: "#FFFF00",
                strokeOpacity: 0.5,
                strokeWeight: 1,
                fillColor: "#FFFF00",
                fillOpacity: 0.3,
                map: map,
                //paths:pointArray
            });
        polygon.setPath(pointArray);
        var val = $('#property-bound').val();
        if(val != '')
            val = val + ',';
        val = val + event.latLng.lat() + ' ' + event.latLng.lng();
        $('#property-bound').val(val);
    }
}

/**
 * Add location draw control onto the map.
 */
function initMapControl()
{
    //Set mode to point mode.
    drawMode = pointMode;
    var pointButton = $('<div id="pointButton">Marker</div>')
        .addClass('mapButton mapButtonActive').click(pointButtonClick);
    var boundButton = $('<div id="boundButton" style="padding-left:6px;padding-right:6px">Bounds</div>')
        .addClass('mapButton').click(boundButtonClick);

    map.controls[google.maps.ControlPosition.TOP_CENTER].push(pointButton[0]);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(boundButton[0]);
}

function pointButtonClick()
{
    drawMode = pointMode;
    $('#pointButton').addClass('mapButtonActive');
    $('#boundButton').removeClass('mapButtonActive');
    map.controls[google.maps.ControlPosition.TOP_CENTER].pop();
}

function boundButtonClick()
{
    drawMode = boundMode;
    $('#pointButton').removeClass('mapButtonActive');
    $('#boundButton').addClass('mapButtonActive');
    var clearBountButton = $('<div id="clearBoundButton" style="padding-left:6px;padding-right:6px">Clear</div>')
        .addClass('mapButton').click(clearBoundButtonClick);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(clearBountButton[0]);
}

function clearBoundButtonClick()
{
    if(polygon != null)
    {
        pointArray = [];
        polygon.setMap(null);
        polygon = null;
    }
    $('#property-bound').val('');
}