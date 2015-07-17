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
        this.addMarkers();
    },
    initOptions: function() {
        this.mapOptions = {
            center: { lat: 32.7688, lng: -85.5285},
            zoom: 6,
            disableDefaultUI:true,
            zoomControl:true,
            scrollwheel: false,
        };
    },
    initEvents: function() {
        google.maps.event.addListener(this.map, 'click', this.onClick);
        google.maps.event.addListener(this.map, 'mouseout', this.onMouseout);
    },
    addMarkers: function() {
        if(!markerPoints)
            return;

        for(var i = 0; i < markerPoints.length; i++){
            window.setTimeout(this.addMarker, i * 300 + 300, markerPoints[i]);
        }
    },
    addMarker: function(p) {
        console.log(p);

        var lat = parseFloat(p.latlon.substring(0, p.latlon.indexOf(' '))),
            lon = parseFloat(p.latlon.substring(p.latlon.indexOf(' ') + 1));

        var marker = new google.maps.Marker({
            map: map.map,
            position: new google.maps.LatLng(lat, lon),
            title: p.headline,
            animation: google.maps.Animation.DROP,
            infoWindow: new google.maps.InfoWindow({
                content:
                    '<div><b><a href="' + p.url + '">' + p.headline + '</a></b></div>' +
                    '<div>' + (p.city ? p.city : p.county) + ', ' + p.state + '</div>' +
                    '<div>' + p.acres + ' acres </div>'
            })
        });

        google.maps.event.addListener(marker, 'click', function(){
            this.infoWindow.open(this.map, this);
        });
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