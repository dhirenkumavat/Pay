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
                            <h2>All Active Brand </h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
								
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Brand Name</th>
                                        <th>Mcoin</th>
                                        <th>Brand Info</th>
                                        <th>Country Name</th>
                                        <th>State Name</th>
                                        <th>City Name</th>
                                        <th>Total Video</th>
                                        <th>Total Outlets</th>
                                        <th>Active Date</th>
                                        <th>Active/Inactive</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
												$i=1; 
												foreach($activebrand as $row){
													$id=$row['id'];
						                         ?>

                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row['brand_name'];?></td>
                                        <td><?php echo $row['mcoin'];?></td>
                                        <td><?php echo $row['brand_info'];?></td>
                                        <td><?php echo $row['country_name'];?></td>
                                        <td><?php echo $row['state_name'];?></td>
                                        <td><?php echo $row['city_name'];?></td>
										<td>
										<?php
										$q = $this->db->query("select * from videos where brand_id='$id'");
                                             echo $q->num_rows();


									  ?>
										</td>
										<td>
										<?php
										$q1 = $this->db->query("select * from outlets where brandid='$id'");
                                             echo $q1->num_rows();


									  ?>
										</td>
                                        <td><?php echo $row['created_date'];?></td>
                                         <td>
                                               <a href="<?=site_url()?>admin/inactivate_brand/<?=$row['id']?>" onclick="return confirm('Are You Sure ?');" class="btn btn-info btn-xs"  data-target="#ordine">Inactive
                                       </a>
                                         </td>
										<td>
                                        <a  href="<?php echo site_url('admin/view_brand_detail/'.$row['id']); ?>"  class="btn btn-info btn-xs"  data-target="#ordine">Modify</a>
                                          </a>
                                         <a href="<?php echo site_url('admin/delete_activebrand/'.$row['id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"  data-target="#ordine">Delete
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
