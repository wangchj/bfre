$(function(){
    $('.imgTile').click(function(){
        window.location.href = $(this).data('url');
    })
});

function initialize() {
    var mapOptions = {
        center: { lat: 32.7688, lng: -85.5285},
        zoom: 6,
        disableDefaultUI:true
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);