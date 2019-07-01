<?php
include ('inc/header.php');
?>
	<!-- Breadcomb area Start-->
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									</div>
			</div>
		</div>
	</div>
	<?php
	?>
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Video List</h2>
					<button type="submit" name="" id="sucbtn" class="btn btn-success notika-btn-success" style="margin-left:86%;margin-top:-49px;"><a href="<?php echo base_url('admin/add_video/'.$this->uri->segment('3'));?>" style="color:white;">Add Videos</a></button>

                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
								
                                    <tr>
                                        <th>Serial No.</th>
                                        <th> Video Name</th>
                                        <th>File Url</th>

                                        <th>Alloted Outlet Name</th>
                                       <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								$i=1; 
								foreach($videos as $row){
                               //$outlet=$row->outletname;
							$outlet_arr = explode(",", $row->outletname);
                            foreach($outlet_arr as $outletss) 
                               {
	                            ?>

                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row->video_file;?></td>
                                        <td><?php echo base_url();?>uploads/videos/<?php echo $row->video_file;?></td>
    
										<td>
										<?php echo $outletss;?>

										</td>
                                        <td><?php echo $row->created_date;?></td>
										<td>
                                        <a href="<?php echo site_url('admin/modify_video/'.$row->id);?>"  class="btn btn-info btn-xs"  data-target="#ordine">Modify</a>
                                          </a>
                                         <a href="<?php echo site_url('admin/delete_video/'.$row->id);?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"  data-target="#ordine">Delete
                                       </a>
                                        </td>
                                    </tr>
									 <?php 
							       $i++;
							         }
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
    <!-- Data Table area End-->
<?php
include ('inc/footer.php');
?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script>
$(document).ready(function() {
    $('#data-table-basic').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>
<style>
#sucbtn {
    color: #fff;
    background-color: #0073c6b8;
    border-color: #0073C6;
}


</style>
