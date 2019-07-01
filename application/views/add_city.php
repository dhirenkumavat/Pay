  <?php
include ('inc/header.php');
?>

<!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<form method="post" enctype="multipart/form-data" action="">
				
				<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="cmp-tb-hd cmp-int-hd">
                            <h2>Add City</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                 <select class="form-control countryid" id="countryid" name="countryid" >
							<option>Select Country Name</option>
							 <?php foreach ($countryi as $countr):

							 ?>
                                    
                                    <option value="<?php echo $countr->id; ?>"><?php echo $countr->country_name; ?></option>
                                    <?php endforeach;?>
						
							
							</select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                 <select class="form-control states" name="state_name">
							      <option>Select State Name</option>
							
							    </select>
                                        </div>
                                </div>
                            </div>
							
							 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                            <input type="text" name="city_name" class="form-control input-sm" placeholder="City Name">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int">
                                    <button type="submit" id="sucbtn" name="submit" class="btn btn-success notika-btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
				
				
				
				
				
				
				
                    
					</form>
                </div>
            </div>
            
            

          </div>
    </div>
	<br><br><br><br><br><br><br><br><br><br><br>
    <!-- Form Element area End-->
	  <?php
include ('inc/footer.php');
?>

<script type="text/javascript">
$(".countryid").on("change", function(){
    var countryid = $(this).val();
   
    $.post("<?=base_url()?>admin/select_state", {countryid: countryid}, 
    function(data){
        $(".states").html(data);
        
    });
});


</script>

   
<style>
#sucbtn {
    color: #fff;
    background-color: #0073C6;
    border-color: #0073C6;
}
</style>
