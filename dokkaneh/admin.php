<!DOCTYPE html>
<html>
<?php
   require_once('includes/links.php');
   require_once('dbconnection.php');

$sql_user="SELECT * FROM users";
$stmt_user=$conn->query($sql_user);
// $users=$stmt_user->fetch(PDO::FETCH_ASSOC);
$count_users=$stmt_user->rowCount();
// echo $count_users;
$sql_order="SELECT * FROM orders";
$stmt_order=$conn->query($sql_order);
$orders=$stmt_order->fetchAll(PDO::FETCH_OBJ);
$count_orders=$stmt_order->rowCount();
$profit=0;
foreach($orders as $order){
	$profit +=$order->payment;
}
?>   
<body>
	
    <!-- sidebar here -->
	<?php
	    require_once('includes/header.php');
	    require_once('includes/sidebar.php');
	?>
	   
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-lg-12">
					<div class="card-header bg-dark text-white text-centre">
						<span>Top content</span>
					</div>
				</div>
				
				<div class="col-lg-3">
					<div class="card-header bg-dark text-white text-centre">
						<span>Users</span>
					</div>
					<div class="card-body">
						<span class="float-left"><i class='fa-solid fa-users icon fa-3x'></i></span>
						<span class="float-right"><?php echo $count_users; ?></span>
					</div>
					<div class="card-footer"></div>
				</div>

				<div class="col-lg-3">
					<div class="card-header bg-dark text-white text-centre">
						<span>Orders</span>
					</div>
					<div class="card-body">
						<span class="float-left"><i class="fa-solid fa-box icon fa-3x"></i></span>
						<span class="float-right"><?php echo $count_orders; ?></span>
					</div>
					<div class="card-footer"></div>
				</div>

				<div class="col-lg-3">
					<div class="card-header bg-dark text-white text-centre">
						<span>Profit</span>
					</div>
					<div class="card-body">
						<span class="float-left"><i class="fa-solid fa-sack-dollar fa-3x"></i></span>
						<span class="float-right"><?php echo $profit; ?></span>
					</div>
					<div class="card-footer"></div>
				</div>

				
				
				<div class="col-lg-12">
					<div class="card-header bg-dark text-white text-centre">
						<span>Store Analysis</span>
					</div>
					<div id="chart_div" style="width: 100%; height: 500px;"></div>

					
				</div>
			</div>

			
		</div>

	</div>
	<!-- All our code. write here   -->

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales','orders','users'],
              ['2016',  <?php echo $profit;?>,<?php echo $count_orders;?>,<?php echo $count_users;?>]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/8b42dcad4f.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>