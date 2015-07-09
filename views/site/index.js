$(function(){
    $('.imgTile').click(function(){
        window.location.href = $(this).data('url');
    })
});

var map = {
    map: null,
    mapOptions: null,
    init: function() {
        this.initOptions();
        this.map = new google.maps.Map(document.getElementById('map-canvas'), this.mapOptions);
        this.initEvents();
    },
    initOptions: function() {
        this.mapOptions = {
            center: { lat: 32.7688, lng: -85.5285},
            zoom: 6,
            disableDefaultUI:true,
            scrollwheel: false
        };
    },
    initEvents: function() {
        google.maps.event.addListener(this.map, 'click', this.onClick);
        google.maps.event.addListener(this.map, 'mouseout', this.onMouseout);
    },
    onClick: function(e) {
        //this.mapOptions.scrollwheel = true;
        this.setOptions({scrollwheel: true});

    },
    onMouseout: function(e) {
        this.setOptions({scrollwheel: false});
    }
}

google.maps.event.addDomListener(window, 'load', map.init());