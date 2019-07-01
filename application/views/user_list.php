<?php
include ('inc/header.php');
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
             <h2>All User Detail</h2>

         </div>
<div class="row">
<form  method="post">

             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="form-example-int form-example-st">
                     <div class="form-group">
                  <select class="form-control country" id="country" name="browser1">
<option>Select Country</option>
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
<select class="form-control state" id="state" name="browser2">
</select>
                    </div>
                 </div>
             </div>

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="form-example-int form-example-st">
                     <div class="form-group">
<select class="form-control city" name="browser3" id="city">

</select>                      
</div>
                 </div>
             </div>


             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="">
<input type="submit" value="Filter" name="submit" id="sucbtn" class="" style="">

<!--<button type="submit" id="sucbtn" name="submit" class="btn btn-success notika-btn-success">Filter</button>-->
                 </div>
             </div>
              </form>
         </div>
<br><br>

<div class="table-responsive">
<form method="post" action="<?php echo base_url();?>notification">
<?php
foreach($browser as $rowss)
{
$citys=$rowss->city;
}
?>
<div class="col-md-3">
<button type="submit" value="" class="btn btn-success" name="submit1"><a href="<?php echo site_url('Admin/view_googlemap/'.$citys); ?>" style="color:white;">View User</a></button>
 </div>
 <div class="col-md-3">
<input type="submit" name="submit"  id="sucbtn" value="Notification">
</div>
             <table id="data-table-basic" class="table table-striped">

                 <thead>

                     <tr>
<th><input type="checkbox" id="checkAl">Select All</th>
             <th> Serial No.</th>

                             <th>Moon Id</th>
                             <th>First Name</th>
                             <th>Last Name</th>
                             <th>Mobile No.</th>
                             <th>Email Address</th>
                             <th>Gender</th>
                             <th>Age</th>
                             <th>Latitude</th>
                             <th>Longitude</th>
                             <th>Country</th>
                             <th>State</th>
                             <th>City</th>
                             <th>Status</th>
                             <th>Created Date</th>
                             <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>

    <?php
if(isset($browser)){
  
          $i=1; 
//print_r($browser);
foreach($browser as $row1)
{
?>
                

                     <tr>
<td>
<input type="checkbox" id="checkItem" class="subchk" name="check[]" value="<?php echo $row1->id; ?>">
</td>         
<td><?php echo $i;?></td>
<td><?php echo $row1->moon_id;?></td>
<td><?php echo $row1->first_name;?></td>
<td><?php echo $row1->last_name;?></td>
<td><?php echo $row1->mobile_no;?></td>
<td><?php echo $row1->email;?></td> 
<td><?php echo $row1->gender;?></td>
<td><?php echo $row1->age_gender;?></td>
<td><?php echo $row1->latitude;?></td>
<td><?php echo $row1->longitude;?></td>
<td><?php echo $row1->country;?></td>
<td><?php echo $row1->state;?></td>
<td><?php echo $row1->city;?></td>
                          <td><span class="label-default label label-danger">Active</span></td>
                           <td><?php echo $row1->created_date;?></td>
                          <td>
                                 <a href="<?php echo site_url('Admin/delete_user/'.$row1->id); ?>" class="btn btn-danger btn-xs" data-target="#ordine"><i class="fa fa-trash-o"></i>
                         </td>
                     </tr>
<?php 
$i++;
                 }



                }else{

    $i=1; 
foreach($users_all as $row)
{
$id=$row->id;
?>
                

<tr id='tr_<?= $id ?>'>
   <td><input type="checkbox" class="chksel" id="checkItem" name="check[]" value="<?php echo $row->id;?>"></td>         
<td><?php echo $i;?></td>

                          <td><?php echo $row->moon_id;?></td>
                          <td><?php echo $row->first_name;?></td>
                          <td><?php echo $row->last_name;?></td>
                          <td><?php echo $row->mobile_no;?></td>
                           <td><?php echo $row->email;?></td> 
                           <td><?php echo $row->gender;?></td>
                            <td><?php echo $row->age_gender;?></td>
                             <td><?php echo $row->latitude;?></td>
                              <td><?php echo $row->longitude;?></td>
                               <td><?php echo $row->country;?></td>
                                <td><?php echo $row->state;?></td>
                                 <td><?php echo $row->city;?></td>
                          <td><span class="label-default label label-danger">Active</span></td>
                           <td><?php echo $row->created_date;?></td>
                          <td>
                                 <a href="<?php echo site_url('Admin/delete_user/'.$row->id); ?>" class="btn btn-danger btn-xs" data-target="#ordine"><i class="fa fa-trash-o"></i>
                         </td>
                     </tr>
<?php 
$i++;
 }



 }
 ?>
                     
                    </tbody>
                 
             </table>
</form>
         </div>


       
 </div>
</div>
</div>
</div>
<!-- Data Table area End-->


<?php
include ('inc/footer.php');
?>

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

<script>
$("#checkAl").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

<script>
// $('#sucbtn11').click(function() {
// var sel = $('input[type=checkbox]:checked').map(function(_, el) {
// return $(el).val();
// }).get();
 
// alert(sel);
// })



</script>

<!-- Script -->
<script type="text/javascript">
//$(document).ready(function(){

// Check all
// $("#checkAl").change(function(){

// var checked = $(this).is(':checked');
// if(checked){
// $(".chksel").each(function(){
   // $(this).prop("checked",true);
// });
// }else{
// $(".chksel").each(function(){
   // $(this).prop("checked",false);
// });
// }
// });

// Changing state of CheckAll checkbox 
// $(".chksel").click(function(){

// if($(".chksel").length == $(".chksel:checked").length) {
// $("#checkAl").prop("checked", true);
// } else {
// $("#checkAl").prop("checked",false);
// }

// });

// Delete button clicked
//$('#sucbtn11').click(function(){

// Confirm alert
// var deleteConfirm = confirm("Are you sure?");
// if (deleteConfirm == true) {

// Get userid from checked checkboxes
// var users_arr = [];
// $(".chksel:checked").each(function(){
   // var userid = $(this).val();

   // users_arr.push(userid);
// });

// Array length
// var length = users_arr.length;

// if(length > 0){

  // AJAX request
  // $.ajax({
     // url: '<?= base_url() ?>admin/notification',
     // type: 'post',
     // data: {user_ids: users_arr},
     // success: function(response){
// console.log(data);
        // Remove <tr>
        // $(".chksel:checked").each(function(){
            // var userid = $(this).val();

            // $('#tr_'+userid).remove();
        // });
     // }
  // });
// }
// } 

// });

// });
</script>







<style>
#sucbtn {
color: #fff;
background-color: #0073C6;
border-color: #0073C6;
height: 34px;
width: 35%;
}

#sucbtn1 {
color: #fff;
background-color: #0073C6;
border-color: #0073C6;
height:33px;
}
#sucbtn11 {
color: #fff;
background-color: #0073C6;
border-color: #0073C6;
height:33px;
}

</style>
