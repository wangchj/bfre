//State variables
var map;

$(function(){
    initJssor();
    initMap();
});

function initJssor() {
    var options = {
        $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlayInterval: 60000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1
        $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
        $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideDuration: 600,                                //Specifies default duration (swipe) for slide in milliseconds
        // $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
        //     $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
        //     $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
        //     $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
        //     $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
        // },
        $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
        },
        $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
            $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
            $Lanes: 2,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
            $SpacingX: 14,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
            $SpacingY: 12,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
            $DisplayPieces: 6,                             //[Optional] Number of pieces to display, default value is 1
            $ParkingPosition: 156,                          //[Optional] The offset position to park thumbnail
            $Orientation: 2                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
        }
    };

    var jssor_slider1 = new $JssorSlider$("slider1_container", options);
    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
        if (parentWidth)
            jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 960), 300));
        else
            window.setTimeout(ScaleSlider, 30);
    }
    ScaleSlider();
    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
    //responsive code end
}

function initMap() {
    
    latLng = getLatLng();
    var myOptions = {
        center: latLng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
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