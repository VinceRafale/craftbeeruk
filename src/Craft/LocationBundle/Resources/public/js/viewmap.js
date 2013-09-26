jQuery(document).ready(function() {
    var mapEl = document.getElementById('map');
    var map = L.map('map');
    L.tileLayer('http://{s}.tile.cloudmade.com/442c4c3cc88b44fa85fd58aa3fd04cf8/997/256/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
    }).addTo(map);
    L.Icon.Default.imagePath = 'http://leafletjs.com/dist/images';
    var lat = mapEl.getAttribute('data-lat');
    var lon = mapEl.getAttribute('data-lon');
    map.setView([lat, lon], 17);
    var marker = L.marker(map.getCenter()).addTo(map);
});