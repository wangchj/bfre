//State variables
var map;

var geocoder;

var pointMode = 0;
var boundMode = 1;
var drawMode;

var marker = null;
var polygon = null;

//Custom map controls
var clearBoundButtn = null;

$(function(){
    initMap();
    initInputMask();
    $('#geocode').click(geocodeButtonClick);
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

    $('#lat, #lon').blur(latlonBlur).keypress(latlonKeypress);

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
        $('#lat').val(event.latLng.lat());
        $('#lon').val(event.latLng.lng());
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
 * Event handler when lat, lon input field lose focus.
 */
function latlonBlur(event)
{
    var lat = parseFloat($('#lat').val());
    var lon = parseFloat($('#lon').val());

    if(!isNaN(lat) && lat >= -90 && lat <= 90 && !isNaN(lon) && lon >= -180 && lon <= 180)
    {
        var latlon = parseLatLng(lat + ' ' + lon);
        map.setCenter(latlon);
        if(marker != null)
            marker.setMap(null);
        marker = new google.maps.Marker({position:latlon, map:map});
        marker.setMap(map);
        $('#property-latlon').val(lat + ' ' + lon);
    }
}

/**
 * Keypress event handler for lat lon input fields.
 */
function latlonKeypress(event)
{
    if(event.which == 13)
    {
        $(this)[0].blur();
        event.preventDefault();
    }
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
        $('#lat').val(latlng.lat());
        $('#lon').val(latlng.lng());
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

function initInputMask()
{
    $('#property-pricetotal, #property-priceacre').inputmask(
    {
        'alias':'numeric',
        'digits':2,
        'groupSize':3,
        'groupSeparator':',',
        'autoGroup':true,
        'rightAlign':false
    });

    $('#property-acres').inputmask(
    {
        'alias':'numeric',
        'groupSize':3,
        'groupSeparator':',',
        'autoGroup':true,
        'rightAlign':false
    });
}

/**
 * Event handler for "From Address" button click.
 */
function geocodeButtonClick()
{
    var addr = $('#property-address').val();
    var city = $('#property-city').val();
    var state = $('#property-state').val();

    if(addr == '' || city == '' || state == '') {
        alert('Address is incomplete.');
        return;
    }

    if(geocoder == null)
        geocoder = new google.maps.Geocoder();

    geocoder.geocode({address: addr + ',' + city + ',' + state}, geocodeCallback);
}

/**
 * Call back function for Google Maps asynchronous Geocoder.geocode().
 * @param res an array of google.maps.GeocoderResult objects.
 * @param status google.maps.GeocoderStatus object.
 */
function geocodeCallback(res, status)
{
    if(status != google.maps.GeocoderStatus.OK) {
        switch(status) {
            case google.maps.GeocoderStatus.ERROR:
                alert('Address to coordinates translation result in error.');
                break;
            case google.maps.GeocoderStatus.INVALID_REQUEST:
                alert('Address to coordinates translation: invalid request.');
                break;
            case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
                alert('Address to coordinates translation: over query limit.');
                break;
            case google.maps.GeocoderStatus.REQUEST_DENIED:
                alert('Address to coordinates translation: request denied.');
                break;
            case google.maps.GeocoderStatus.UNKNOWN_ERROR:
                alert('Address to coordinates translation: unknown error.');
                break;
            case google.maps.GeocoderStatus.ZERO_RESULTS:
                alert('Address to coordinates translation returned no result.');
        }
        return;
    }

    var latLng = res[0].geometry.location;

    if(marker != null)
        marker.setMap(null);
    marker = new google.maps.Marker({position:latLng, map:map});
    marker.setMap(map);
    $('#property-latlon').val(latLng.lat() + ' ' + latLng.lng());
    $('#lat').val(latLng.lat());
    $('#lon').val(latLng.lng());
    map.setCenter(latLng);
}