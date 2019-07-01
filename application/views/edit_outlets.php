  <?php
include ('inc/header.php');
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9E5H7XyFv69gegtnSD1TrtPur7dvWn2E
&sensor=false"></script>

        <script type="text/javascript" src="map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0Hlnn3NRy4rbLbsEWawW3P3asuub6CsA&callback=initMap" async defer></script>

<script type="text/javascript">


var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').value = str;
}

function updateMarkerPosition(latLng) {
    
    document.getElementById("lat").value = latLng.lat();

document.getElementById("lng").value = latLng.lng();

}


function updateMarkerAddress(str) {
    
     document.getElementById('address').value = str;
    
}

function initialize() {
	
			var address = document.getElementById("city").value;
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var x = document.getElementById("latbox").value=latitude;

				var longitude = results[0].geometry.location.lng();
				var y = document.getElementById("lngbox").value=longitude;
			} 
		
//alert(x);
  var latLng = new google.maps.LatLng(x,y);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 9,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });

  updateMarkerPosition(latLng);
  geocodePosition(latLng);

  //Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
  });
}

//Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php if($this->session->flashdata('fail')){ ?>
                                        <div class="alert alert-danger"><?= $this->session->flashdata('fail') ?></div>
                                        <?php } ?>
                                        <?php if($this->session->flashdata('success')){ ?>
                                        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                                        <?php } ?>

				<form method="post" enctype="multipart/form-data" action="">
                    <div class="form-element-list">

                        <div class="cmp-tb-hd bcs-hd">
                            <h2>Add Outlet</h2>
                        </div>
						
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Outlet Name</label>
                                        <input type="text" value="<?php echo set_value('name', $outletss->name);?>" class="form-control" name="name" placeholder="Outlet Name">
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                     <label>Address</label>

                                        <input type="text" class="form-control" value="<?php echo set_value('address', $outletss->address);?>" name="address" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                     <label>Country</label>
<select class="form-control country" id="country" name="country">
								 <option>Select Country</option>
                            <?php foreach ($countryi as $countr):

							 ?>
                           <option value="<?php echo $countr->id; ?>" <?php
                                            if (set_value('country', $outletss->country) == $countr->id) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $countr->country_name; ?></option>
                                    <?php endforeach;?>
						
								 </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    
                                      <label>State</label>

<select class="form-control state" id="state" name="state">
								<option><?php echo set_value('state', $outletss->state);?></option>

								</select>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                       <label>City</label>

                                <select class="form-control city" onchange="return initialize()" name="city" id="city">
								<option><?php echo set_value('city', $outletss->city);?></option>

								 </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
				                     <label>Pincode</label>

                                        <input type="text" onchange="return initialize()" class="form-control" placeholder="Pincode" name="pincode" value="<?php echo set_value('pincode', $outletss->pincode);?>">
                                </div>
                            </div>
                        </div>
						
						<div id="mapCanvas"></div>

                             <div id="infoPanel">
   
    <b style="display: none;">Marker status:</b>
    <div id="markerStatus"  style="display: none;"><i>Click and drag the marker.</i></div>
    
     <b style="display: none;">Current position:</b>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                          <label class="bmd-label-floating">Latitude </label>
                          <input type="text"  class="form-control" name="latitude" value="<?php echo set_value('latitude', $outletss->latitude);?>" id="lat">
                        </div>
                      
					  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                          <label class="bmd-label-floating">Longitude </label>
                          <input type="text"  class="form-control" name="longitude" id="lng" value="<?php echo set_value('longitude', $outletss->longitude);?>">
                        </div>
    
    

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                          <label class="bmd-label-floating">Location </label>
                          <input type="text" class="form-control" name="location" id="address" value="address" value="<?php echo set_value('location', $outletss->location);?>">
                        </div>
      
                      </div>
                     
						<div id="latlong" style="display:none;">
	<p>Latitude: <input size="20" type="text" id="latbox" name="lat" ></p>
	<p>Longitude: <input size="20" type="text" id="lngbox" name="lng" ></p>
</div>

						
			           
						 <div class="form-example-int mg-t-15">
                            <button type="submit" name="update" class="btn btn-success notika-btn-success">Update</button>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            
            

          </div>
    </div>
	<br><br><br>
    <!-- Form Element area End-->
	  <?php
include ('inc/footer.php');
?>
   
<script type="text/javascript">
$(".country").on("change", function(){
    var country = $(this).val();
   
    $.post("<?=base_url()?>admin/select_state1", {country: country}, 
    function(data){
        $(".state").html(data);
        
    });
});


</script>

<script type="text/javascript">
$(".state").on("change", function(){
    var state = $(this).val();
			   console.log(state);

    $.post("<?=base_url()?>admin/select_city1", {state: state}, 
    function(data){
		   //console.log(data);

        $(".city").html(data);
        
    });
});


</script>

<style>
#mapCanvas {
    width:800px;
    height: 400px;
   
  }
  #infoPanel {
   
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
.ms-options-wrap, .ms-options-wrap * {
    box-sizing: border-box;
    list-style-type: none !important;
}
#sucbtn {
    color: #fff;
    background-color: #0073C6;
    border-color: #0073C6;
}

</style>
