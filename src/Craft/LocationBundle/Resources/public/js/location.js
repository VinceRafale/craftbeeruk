jQuery(document).ready(function() {
    var baseUrl = jQuery('.navbar-brand').attr('href');
    var watch = navigator.geolocation.watchPosition(function(position) {
        
        jQuery.ajax({
            url:baseUrl+'location/around/'+position.coords.latitude+'/'+position.coords.longitude+'/10',
            success: function(data) {
                jQuery('#ajaxResults').html(data);
            }
            
        });
       
    }, null, {enableHighAccuracy: true});
});