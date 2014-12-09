/**
 * Parse lat/lon string of format 38.38283 60.38283
 * @param str a string containing lat/lon
 * @return google.maps.LatLng
 */
function parseLatLng(latlngStr)
{
    latlngStr = latlngStr.trim();
    pos = latlngStr.indexOf(' ');
    lat = parseFloat(latlngStr.substring(0, pos));
    lng = parseFloat(latlngStr.substring(pos + 1));
    latlng = new google.maps.LatLng(lat, lng);
    return latlng;
}