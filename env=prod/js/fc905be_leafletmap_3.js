jQuery(document).ready(function() {
    var geoFormField = jQuery('#location_geolocation');
    var map = L.map('map');
    L.tileLayer('http://{s}.tile.cloudmade.com/442c4c3cc88b44fa85fd58aa3fd04cf8/997/256/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
    }).addTo(map);
    map.setView([53.001562274591464,-1.7138671875], 5);
    L.Icon.Default.imagePath = 'http://leafletjs.com/dist/images';
    var marker;
    
        marker = L.marker(map.getCenter(), {"draggable": true}).addTo(map);
        if (geoFormField.val().length > 0) {
             map.setView(L.geoJson(JSON.parse(geoFormField.val())).getBounds().getCenter(), 18);
             marker.setLatLng(map.getCenter());
        } else {
            map.locate({'setView': true});
            map.on('locationfound',function(e) {
                marker.setLatLng(e.latlng);
                geoFormField.val(JSON.stringify(marker.toGeoJSON().geometry));
            })
        }
        
        marker.on('dragend', function(e) {
            geoFormField.val(JSON.stringify(this.toGeoJSON().geometry));

        });
    map.on('load', function(e) {
        
        
    })

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        geoFormField.val(JSON.stringify(marker.toGeoJSON().geometry));
    })
});


