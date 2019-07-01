  <?php
include ('inc/header.php');
   error_reporting(1);

?>
<style>
.inbox-status ul.inbox-st-nav li a {
    color: #333;
    font-size: 13px;
    display: block;
}
</style>
<!-- Breadcomb area Start-->
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-ctn">
									<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>search_moonid">


                   <div class="col-lg-6">
                                <div class="form-group">
                                    <label>MoonId</label>
                                    <input type="text" class="form-control" id="start_date" name="moon_id" placeholder="Enter MoonId" value="" required>
                                </div>
                            

                 <button type="submit" name="submit" id="sucbtn" class="btn">Search</button>
						                                </div>

						</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
    <!-- Inbox area Start-->
	<?php
				if(isset($moonid)){
				?>
    <div class="inbox-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="inbox-left-sd">
						<div class="compose-ml">
                            <a class="btn" href="#">Detail</a>
                        </div>
                        <div class="inbox-status" style="">
                            <ul class="inbox-st-nav inbox-ft">
                                <li style=""><a href="#"> Hashtag Accept Video<span class="pull-right">
                         <?php
						 $mid1=$this->input->post('moon_id');

							$q1 = $this->db->query("select user_register.*,hashtag_invites.status from user_register INNER JOIN hashtag_invites on hashtag_invites.receiver_id=user_register.moon_id where hashtag_invites.status='Accepted' AND hashtag_invites.receiver_id='$mid1'");
                               echo $q1->num_rows();


									  ?>		
									  </span></a></li>
                                <li><a href="#"> Hashtag Block Video<span class="pull-right">
                         <?php
						 $mid=$this->input->post('moon_id');
							$q = $this->db->query("select user_register.*,hashtag_invites.status from user_register INNER JOIN hashtag_invites on hashtag_invites.receiver_id=user_register.moon_id where hashtag_invites.status='block' AND hashtag_invites.receiver_id='$mid'");
                               echo $q->num_rows();


									  ?>	

								</span></a></li>
								
								<li><a href="#">Followers<span class="pull-right">
                         <?php
						        foreach($moonid as $row11)
                                {
									$uid=$row11->id;
								}
						 //$moon_id=$this->input->post('moon_id');
						 
							$q = $this->db->query("select user_register.*,followers.user_id from user_register INNER JOIN followers on followers.user_id=user_register.id where followers.user_id='$uid'");
                               echo $q->num_rows();


									  ?>	

								</span></a></li>
								
					<li><a href="#">Following<span class="pull-right">
                         <?php
						        foreach($moonid as $row11)
                                {
									 $uid=$row11->id;
								}
						 $moon_id=$this->input->post('moon_id');
							$q = $this->db->query("select user_register.*,followers.follower_id from user_register INNER JOIN followers on followers.follower_id=user_register.id where followers.follower_id='$uid'");
                               echo $q->num_rows();


									  ?>	

								</span></a></li>

                            </ul>
                        </div>
                        
                        <hr>
                        
                    </div>
                </div>
				
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="view-mail-list sm-res-mg-t-30">
                        <div class="view-mail-hd">
                            <div class="view-mail-hrd">
                                <h4>Information</h4>
                            </div>

                        </div>
                        
                        <div class="view-mail-atn">
                            <table class="table" id="myTable">
                    <tbody>
						<?php
// $data="How to split a string using explode";
// $splittedstring=explode(" ",$data);
// foreach ($splittedstring as $key => $value) {
// echo "".$value."<br>";
// }
?>
                        <?php 
                         $i=1; 
       foreach($moonid as $row1)
						 {
						 
							 ?>
                    
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $row1->first_name;?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $row1->last_name;?></td>
                    </tr>
                    <tr>
                        <td>Mobile No.</td>
                        <td><?php echo $row1->mobile_no;?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $row1->email;?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo $row1->gender;?></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><?php echo $row1->age_gender;?></td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td><?php echo $row1->latitude;?></td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td><?php echo $row1->longitude;?></td>
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
    </div>
	<?php
				}
				?>
    <!-- Inbox area End-->
	<br>	<br><br>	<br><br>	<br>
	<br>
	<br>
	<br>

<?php
include ('inc/footer.php');
?>
   
