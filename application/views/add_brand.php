  <?php
include ('inc/header.php');
?>
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
                            <h2>Add Brand</h2>
                        </div>
						
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Brand Name</label>
                                        <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                       <label>Mcoin</label>

                                        <input type="text" class="form-control" name="mcoin" placeholder="Mcoin">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
							        <label>Brand Message</label>

                                        <input type="text" class="form-control" name="brand_msg" placeholder="Brand Message">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
						        <label>Brand Information</label>

                                  <input type="text" class="form-control" placeholder="Brand Info" name="brand_info">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                    		  <label>Download Message</label>

                              <input type="text" class="form-control" placeholder="Download Message" name="download_msg">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                   
								  <label>Download Link</label>

                                        <input type="text" class="form-control" placeholder="Download Link" name="download_link">
                                </div>
                            </div>
                        </div>
						
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                                                        
							  <label>Country</label>
                                 <select class="form-control country" id="country" name="countryname">
								 <option>Select Country</option>
                            <?php foreach ($countryi as $countr):

							 ?>
                           <option value="<?php echo $countr->id; ?>"><?php echo $countr->country_name; ?></option>
                                    <?php endforeach;?>
						
								 </select>
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
							          <label>State</label>
                                <select class="form-control state" id="state" name="statename">
								</select>
                                        <!--<input type="text" class="form-control" placeholder="State" name="statename">-->
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
					          <label>City</label>
                                <select class="form-control city" name="cityname" id="city">

								 </select>
                                </div>
                            </div>
                        </div>
                             <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
							        <label>Privacy Policy</label>

                                        <input type="text" class="form-control" name="privacy_policy" placeholder="Privacy Policy">
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    
				                     <label>Brand Terms & conditions</label>

                                        <input type="text" class="form-control" name="brand_tc" placeholder="Brand Terms & conditions">
                                    
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
		                    <label>Play Store Link</label>

                                        <input type="text" class="form-control" placeholder="Play Store Url" name="playstore_url">

                                </div>
                            </div>
                        </div>
						
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    
									  <label>Brand Logo</label>

									<input type="file" id="file" class="form-control" name="brand_logo">
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    
							  <label>Thumb</label>

                      <input type="file" id="file" name="thumb_url" class="form-control">

                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    
									  <label>HashTag</label>

                                        <input type="text" class="form-control" placeholder="HashTag" name="hashtag">

                                </div>
                            </div>
                        </div>
						
						 <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    
					              <label>Question Type</label>

                                    <select class="form-control" name="ques_type" id="ddlPassport">
											<option>Select Question Type</option>
											<option value="Objective">Objective</option>
											<option value="Descriptive">Descriptive</option>
										</select>
                                
                                    
                                   
                                </div>
                            </div>
							
							<div id="dvPassport" style="display: none">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                     <label>Options</label>

                                        <input id="txtPassportNumber"  type="text" class="form-control" placeholder="Option1" name="option1">
                                        <input id="txtPassportNumber"  type="text" class="form-control" placeholder="Option2" name="option2">
                                        <input id="txtPassportNumber"  type="text" class="form-control" placeholder="Option3" name="option3">
                                        <input id="txtPassportNumber"  type="text" class="form-control" placeholder="Option4" name="option4">

                                </div>
                            </div>
						   </div>

							
							<div id="dvPassport3" style="display: none" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                 <label>Question</label>

                                        <input id=""  type="text" class="form-control" placeholder="Question" name="question">

                                </div>
                            </div>

							
                          
                        </div>
						
			           
						 <div class="form-example-int mg-t-15">
                            <button type="submit" name="submit" id="succbtn" class="btn btn-success notika-btn-success">Submit</button>
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
    $(function () {
        $("#ddlPassport").change(function () {
            if ($(this).val() == "Objective") {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
	
	$(function () {
        $("#ddlPassport").change(function () {
            if ($(this).val() == "Descriptive") {
                $("#dvPassport3").show();
            } else {
                $("#dvPassport3").hide();
            }
        });
    });
</script>
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
#succbtn {
    color: #fff;
    background-color: #0073C6;
    border-color: #0073C6;
}


</style>
