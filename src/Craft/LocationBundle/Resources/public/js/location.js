jQuery(document).ready(function() {
    var watch = navigator.geolocation.watchPosition(function(position) {
        var baseUrl = jQuery('.brand').attr('href');
        jQuery.ajax({
            url:baseUrl+'location/around/'+position.coords.latitude+'/'+position.coords.longitude+'/1',
            success: function(data) {
                jQuery('#ajaxResults').html(data);
            }
            
        });
       
    }, null, {enableHighAccuracy: true});
});