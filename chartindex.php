<!DOCTYPE html>
<html>
<head>
	<title>chart js</title>
	<script type="text/javascript" src="chartjs/Chart.js"></script>
</head>
<body>
	<?php 
	require_once('db_login.php');
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()) {
		die("Could not connect to the database: <br />" .
			mysqli_connect_error());
	}
	?>

	<center> <h2 style="font-family: Arial;"> Grafik Produk per Kategori </h2></center>

	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>

	<br/>
	<br/>
<!-- 
	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>id produk</th>
				<th>id kategori</th>
				<th>nama produk</th>
				<th>Stok</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			$data = mysqli_query($con,"select * from produk");
			while($d=mysqli_fetch_array($data)){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['idproduk']; ?></td>
					<td><?php echo $d['idkategori']; ?></td>
					<td><?php echo $d['nama_produk']; ?></td>
					<td><?php echo $d['stok']; ?></td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table> -->

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["PC/Laptop", "Handphone", "Monitor", "Accessories"],
				datasets: [{
					label: '',
					data: [
						<?php 
						$pclaptop = mysqli_query($con,"select * from produk where idkategori='1'");
						echo mysqli_num_rows($pclaptop);
						?>, 
						<?php 
						$handphone = mysqli_query($con,"select * from produk where idkategori='2'");
						echo mysqli_num_rows($handphone);
						?>, 
						<?php 
						$monitor = mysqli_query($con,"select * from produk where idkategori='3'");
						echo mysqli_num_rows($monitor);
						?>, 
						<?php 
						$accessories = mysqli_query($con,"select * from produk where idkategori='4'");
						echo mysqli_num_rows($accessories);
						?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>