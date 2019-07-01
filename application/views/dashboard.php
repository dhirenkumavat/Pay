<?php
include ('inc/header.php');
?>
    <!-- Start Status area -->
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">
                                           <?php 
                                           
                                            $query = $this->db->query("SELECT * FROM `user_register`");
                                   echo $query->num_rows();
                                            ?>							
							</span></h2>
                            <p>Total Users</p>
                        </div>
                        <div class="sparkline-bar-stats1"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">
							 <?php 
                                           
                                   $query1 = $this->db->query("SELECT * FROM `brands`");
                                   echo $query1->num_rows();
                                            ?>
							</span></h2>
                            <p>Total Brands</p>
                        </div>
                        <div class="sparkline-bar-stats2"></div>
                    </div>
                </div>
				  </div>
          <br>
          <br>
<div class="row">
                <div class="col-md-6">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="width:137%;">
    <div id="chart_div"></div>

                    </div>
                </div>
                <!--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">1,000</span></h2>
                            <p>Total Support Tickets</p>
                        </div>
                        <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
   

<?php
        $query_count = $this->db->query("SELECT status FROM brands where status='1'");
         $c_var=$query_count->num_rows();

		 $query_count1 = $this->db->query("SELECT status FROM brands where status='0'");
           $c_var1=$query_count1->num_rows();

		   $query_count2 = $this->db->query("SELECT * FROM user_register");
           $c_var2=$query_count2->num_rows();

		   	$query_count3 = $this->db->query("select user_register.*,hashtag_invites.status from user_register INNER JOIN hashtag_invites on hashtag_invites.receiver_id=user_register.moon_id where hashtag_invites.status='Accepted'");
           $c_var3=$query_count3->num_rows();

		   $query_count4 = $this->db->query("select user_register.*,hashtag_invites.status from user_register INNER JOIN hashtag_invites on hashtag_invites.receiver_id=user_register.moon_id where hashtag_invites.status='block'");
           $c_var4=$query_count4->num_rows();

		?>
           
    
	      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Total Active Users', <?php echo $c_var;?>],
          ['Total InActive Users', <?php echo $c_var1;?>],
          ['Total Users', <?php echo $c_var2;?>],
		  ['Hashtag Video Accepted', <?php echo $c_var3;?>],
          ['Hashtag Video Blocked', <?php echo $c_var4;?>],
        ]);

        // Set chart options
        var options = {
		         'pieHole': 0.4,

                       'width':600,
                       'height':500
					   };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

	  
	  
	  
	  
	  
    </script>
  
  
  
   <?php
include ('inc/footer.php');
?>