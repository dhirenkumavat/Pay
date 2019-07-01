  <?php
include ('inc/header.php');
?>
<!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="search-box">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Outlets Detail</h5>
                    </div>
                     
                </div>
            </div>
		<div class="search-list">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                                                   </tr>
                    </thead>
                    <tbody>
                        
                    
                    <tr>
                        <td>Outlets Name</td>
                        <td><?php echo set_value('name', $outletss->name);?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo set_value('address', $outletss->address);?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php echo set_value('country', $outletss->country);?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo set_value('state', $outletss->state);?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo set_value('city', $outletss->city);?></td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td><?php echo set_value('pincode', $outletss->pincode);?></td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td><?php echo set_value('latitude', $outletss->latitude);?></td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td><?php echo set_value('longitude', $outletss->longitude);?></td>
                    </tr>
					<tr>
                        <td>Location</td>
                        <td><?php echo set_value('location', $outletss->location);?></td>
                    </tr>
					<tr>
					<td>
					
					<button type="submit" name="" class="btn btn-success notika-btn-success"><a href="<?php echo site_url('admin/edit_outlets/'.$outletss->id); ?>" style="color:white;">Edit</a></button>

					</td>
					</tr>
                    </tbody>
                </table>

            </div>
                </div>
            </div>
            
            

          </div>
    </div>
	<br><br><br>
    <!-- Form Element area End-->
	  <?php
include ('inc/footer.php');
?>
   

<style>
.search-table{
    padding: 10%;
    margin-top: -6%;
}
.search-box {
    background:darkgrey;
    border: 1px solid #ababab;
    padding: 2%;
    color: white;
	}
.search-box input:focus{
    box-shadow:none;
    border:2px solid #eeeeee;
}
.search-list{
    background: #fff;
    border: 1px solid #ababab;
    border-top: none;
}
.search-list h3{
    background: #eee;
    padding: 3%;
    margin-bottom: 0%;
}
</style>
