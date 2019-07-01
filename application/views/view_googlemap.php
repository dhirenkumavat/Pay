<?php
//include ('inc/header.php');
?>
<div id="mapCanvas"></div>
<style type="text/css">
    #mapCanvas {
    width: 100%;
    height: 100%;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9E5H7XyFv69gegtnSD1TrtPur7dvWn2E
"></script>

<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(10);
	
    // Multiple markers location, latitude, and longitude
   var markers = [
   <?php
  
	$locations = array();
foreach($userss as $college)
{
	$latitude=$college->latitude;
	$longitude=$college->longitude;
	 $city=$college->city;
	
   $locations[] = array($city,$longitude,$latitude);
?>
        ['<?php echo $city;?>', <?php echo $latitude;?>, <?php echo $longitude;?>],
<?php
		}
     ?> 
	]; 
      //alert(locations);

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for(i = 0; i < markers.length; i++) {
		
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
		//alert(position);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(10);
        google.maps.event.removeListener(boundsListener);
    });
    
}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>
<?php
//include ('inc/footer.php');
?>