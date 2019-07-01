  <?php
include ('inc/header.php');
?>
<style type="text/css">
    button.multiselect.dropdown-toggle.btn.btn-default {
    width: 360px;
}
</style>
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
                            <h2>Notification</h2>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">

<div class="col-md-3">
                                        <label class="hrzn-fm">User</label>
                                    </div>
<div class="col-md-7">
                                     <select id="chkveg" multiple="multiple" name="user_id[]" class="form-control input-sm"  required="required">

                          <?php
                          foreach ($users_all as  $row) {
                         ?>
                            <option value="<?php echo $row->id;?>"><?php echo $row->first_name;?></option>
<?php }?>
                                               
                      </select>
                  </div>
              </div>
<br>
<br>
               <div class="row">
                                    <div class="col-md-3">
                                        <label class="hrzn-fm">Message</label>
                                    </div>
                                    <div class="col-md-7">
                                            <textarea class="form-control input-sm" placeholder="" name="msg"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-example-int mg-t-15">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <button type="submit" id="sucbtn" class="btn btn-success notika-btn-success" name="submit">Send Notification</button>
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
	<br><br><br><br><br><br><br><br><br><br>
    <!-- Form Element area End-->
	  <?php
include ('inc/footer.php');
?>
   
<style>
#sucbtn {
    color: #fff;
    background-color: #0073C6;
    border-color: #0073C6;
}
</style>
 <link rel="stylesheet" href="css/bootstrap-3.1.1.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>

<script type="text/javascript">
$(function() {

$('#chkveg').multiselect({

includeSelectAllOption: true

});

$('#btnget').click(function() {

alert($('#chkveg').val());

})

});
</script>