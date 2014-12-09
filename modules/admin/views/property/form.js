//State variables
var map;

var pointMode = 0;
var boundMode = 1;
var drawMode;

var marker = null;
var polygon = null;

//Custom map controls
var clearBoundButtn = null;

$(function(){
    initMap();
});

function initMap() {
    ///<summary>Initializes spatial tool Google map.</summary>

    var myOptions = {
        center: new google.maps.LatLng(32.606, -85.481),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        //mapTypeControl: false, panControl: false, streetViewControl: false, zoomControl: false
    };

    map = new google.maps.Map(document.getElementById("map"),
        myOptions);

    loadMapOverlay();
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
        if(polygon == null)
            makeBoundPolygon();

        polygon.getPath().push(event.latLng);

        //Form data value
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
    clearBoundButton = $('<div id="clearBoundButton" style="padding-left:6px;padding-right:6px">Clear</div>')
        .addClass('mapButton').click(clearBoundButtonClick);

    map.controls[google.maps.ControlPosition.TOP_CENTER].push(pointButton[0]);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(boundButton[0]);
}

/**
 * Load saved marker and polygon, if data exist.
 */
function loadMapOverlay()
{
    if(typeof pointStr != 'undefined' && pointStr != null && pointStr != '')
    {
        latlng = parseLatLng(pointStr);
        map.setCenter(latlng);
        marker = new google.maps.Marker({position:latlng, map:map});
        $('#point').html(latlng.toUrlValue());
    }
    if(typeof boundStr != 'undefined' && boundStr != null && boundStr != '')
    {
        makeBoundPolygon();
        strs = boundStr.split(',');
        for(i = 0; i < strs.length; i++)
            polygon.getPath().push(parseLatLng(strs[i]));
    }
}

/**
 * Create a new polygon with a color style, and set click event handler.
 * @param path Array.<LatLng> or google.maps.MVCArray.<LatLng>. optional
 * @return the polygon, which is already added to map.
 */
function makeBoundPolygon(path)
{
    polygon = new google.maps.Polygon({
        strokeColor: "#FFFF00",
        strokeOpacity: 0.5,
        strokeWeight: 1,
        fillColor: "#FFFF00",
        fillOpacity: 0.3,
        map: map,
    });

    //Polygon click handler
    google.maps.event.addListener(polygon, 'click', mapClick);

    //Check if path was passed in
    if (typeof path != 'undefined' && path != null) {
        polygon.setPath(path);
    }

    return polygon;
}

function pointButtonClick()
{
    drawMode = pointMode;
    $('#pointButton').addClass('mapButtonActive');
    $('#boundButton').removeClass('mapButtonActive');
    if($.contains(document, clearBoundButton[0]))
        map.controls[google.maps.ControlPosition.TOP_CENTER].pop();
}

function boundButtonClick()
{
    drawMode = boundMode;
    $('#pointButton').removeClass('mapButtonActive');
    $('#boundButton').addClass('mapButtonActive');
    if(!$.contains(document, clearBoundButton[0]))
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(clearBoundButton[0]);
}

function clearBoundButtonClick()
{
    if(polygon != null)
    {
        polygon.getPath().clear();
    }

    $('#property-bound').val('');
}