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
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Outlet List</h2>
					<button type="submit" name="" id="sucbtn" class="btn btn-success notika-btn-success" style="margin-left:86%;margin-top:-49px;"><a href="<?php echo base_url('admin/add_outlet/'.$this->uri->segment('3'));?>" style="color:white;">Add Outlet</a></button>

                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
								
                                    <tr>
                                        <th>Serial No.</th>
                                        <th> Name</th>
                                        <th>Location</th>
                                        <th>Country Name</th>
                                        <th>State Name</th>
                                        <th>City Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
												$i=1; 
												foreach($outletdata as $row){
						                         ?>

                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->location;?></td>
                                        <td><?php echo $row->country;?></td>
                                        <td><?php echo $row->state;?></td>
                                        <td><?php echo $row->city;?></td>
                                        <td><?php echo $row->created_date;?></td>
										<td>
                                        <a href="<?php echo site_url('admin/view_outlet_detail/'.$row->id);?>"  class="btn btn-info btn-xs"  data-target="#ordine">Modify</a>
                                          </a>
                                         <a href="<?php echo site_url('admin/delete_outlet/'.$row->id);?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"  data-target="#ordine">Delete
                                       </a>
                                        </td>
                                    </tr>
									 <?php 
							       $i++;
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
    background-color: #0073c6ab;
    border-color: #0073C6;
}


</style>