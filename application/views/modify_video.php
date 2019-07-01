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

				<form method="post" enctype="multipart/form-data" action="" id="myform">
                    <div class="form-element-list">

                        <div class="cmp-tb-hd bcs-hd">
                            <h2>Edit Detail</h2>
                        </div>
						
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Select Video</label>
                                        <input type="file" class="form-control" name="" value="<?php echo base_url();?>uploads/videos/<?php echo set_value('video_file', $videoes->video_file);?>" id="myfile">
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                     <label>Select Outlet Name</label><br>
<select id="chkveg" multiple="multiple" name="" class="form-control" style="">
    <?php foreach ($outletdata as $outlet):

							 ?>
                                    
                                    <option value="<?php echo $outlet->id; ?>" <?php
                                            if (set_value('outletname', $videoes->outletname) == $outlet->id) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $outlet->name;?></option>
                                    <?php endforeach;?>
						
</select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                     <label>Remark</label>

                                        <input type="text" class="form-control" value="<?php echo set_value('remark', $videoes->remark);?>" placeholder="Remark" id="remark">
                                        <input type="hidden" class="form-control" value="<?php echo $this->uri->segment('3');?>" id="brand_id">
                                </div>
                            </div>
							
							 
                        </div>
                        
						<div class="form-group">
                        <div class="progress" style="max-width:100%;">
                            <div class="progress-bar progress-md progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
 
                        <div class="msg"></div>
                    </div>

						<div class="form-example-int mg-t-15">
                            <button type="submit" name="update" id="sucbtn" class="btn btn-success notika-btn-success" id="btn">Update</button>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            
            

          </div>
    </div>
	<br><br><br><br><br><br>
    <!-- Form Element area End-->
	  <?php
include ('inc/footer.php');
?>

<link rel="stylesheet" href="css/bootstrap-3.1.1.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
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
<script>
            $(function () {
                $('#btn').click(function () {
                    $('.myprogress').css('width', '0');
                    $('.msg').text('');
                   
                    var myfile = $('#myfile').val();

                    var chkveg = $('#chkveg').val();

                    var remark = $('#remark').val();
                    var brand_id = $('#brand_id').val();
                    if (chkveg == '' || myfile == '' || remark=='') {
                        alert('Please fill all fields');
                        return;
                    }
                    var formData = new FormData();
                     formData.append('myfile', $('#myfile')[0].files[0]);
                    formData.append('remark', remark);
                    formData.append('chkveg', chkveg);
                    formData.append('brand_id', brand_id);
                    
					$('#btn').attr('disabled', 'disabled');
                     $('.msg').text('Uploading in progress...');
                    $.ajax({
                        url: '<?= base_url('admin/modify_video') ?>',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        // this part is progress bar
                        xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $('.myprogress').text(percentComplete + '%');
                                    $('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (data) {
                            $('#myfile').val('');
                            $('.msg').text(data);
                            $('#btn').removeAttr('disabled');
                            $('.myprogress').text('0%');
                            $('.myprogress').css('width','0%');
                        }
                    });
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
