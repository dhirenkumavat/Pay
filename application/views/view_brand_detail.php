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
                        <h5>Brand Detail</h5>
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
                        <?php 
                         $i=1; 
						 foreach($brandsss as $row1)
						 {
						 
							 ?>
                    
                    <tr>
                        <td>Brand Name</td>
                        <td><?php echo $row1->brand_name;?></td>
                    </tr>
                    <tr>
                        <td>Mcoin</td>
                        <td><?php echo $row1->mcoin;?></td>
                    </tr>
                    <tr>
                        <td>Brand Info</td>
                        <td><?php echo $row1->brand_info;?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php echo $row1->country_name;?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $row1->state_name;?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $row1->city_name;?></td>
                    </tr>
                    <tr>
                        <td>Brand Logo</td>
                        <td><img src="<?php echo base_url();?>uploads/images/<?php echo $row1->brand_logo;?>" width="40px;"></td>
                    </tr>
                    <tr>
                        <td>Thumb Url</td>
                        <td><img src="<?php echo base_url();?>uploads/images/<?php echo $row1->thumb_url;?>" width="40px;"></td>
                    </tr>
					<tr>
					<td>
					
					<button type="submit" name="" id="sucbtn" class="btn btn-success notika-btn-success"><a href="<?php echo site_url('admin/edit_brand/'.$row1->id); ?>" style="color:white;">Edit</a></button>

					<button type="submit" name="" id="sucbtn" class="btn btn-success notika-btn-success"><a href="<?php echo site_url('admin/video_list/'.$row1->id); ?>" style="color:white;">Videos</a></button>
                    <button type="submit" name="" id="sucbtn" class="btn btn-success notika-btn-success"><a href="<?php echo site_url('admin/outlet_list/'.$row1->id); ?>" style="color:white;">Outlets</a></button>
					</td>
					</tr>
					<?php
						 }
						 ?>
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
#sucbtn {
    color: #fff;
    background-color: #0073C6;
    border-color: #0073C6;
}



</style>
