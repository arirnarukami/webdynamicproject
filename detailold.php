<!DOCTYPE html>
<html>

<head>
	<title>Detail</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>

	<!-- css sheet -->
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>
	<?php
	// Include our login information 
	require_once('db_login.php');
	// Connect 
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()) {
		die("Could not connect to the database: <br />" .
			mysqli_connect_error());
	}
	//Asign a query 

	//$query = " SELECT  p.idproduk, p.nama as nama_produk, k.nama as nama_kategori, sbk.nama as nama_subkategori, peg.nama_lengkap AS nama_pegawai   FROM produk as p JOIN kategori as k ON p.idkategori=k.idkategori JOIN subkategori as sbk on p.idsubkategori=sbk.idsubkategori JOIN pegawai as peg on p.idpegawai= peg.idpegawai";
	// $query = "SELECT * FROM produk as p JOIN kategori as k ON p.idkategori=k.idkategori JOIN subkategori as sbk on p.idsubkategori=sbk.idsubkategori JOIN pegawai as peg on p.idpegawai= peg.idpegawai";

	$a =  $_GET['id'];
	$query = "SELECT * FROM produk as p JOIN kategori as k ON p.idkategori=k.idkategori JOIN subkategori as sbk on p.idsubkategori=sbk.idsubkategori JOIN pegawai as peg on p.idpegawai= peg.idpegawai where p.idproduk=$a";
	$query_k = "SELECT k.nama_kategori FROM kategori as k";
		$query_s = "SELECT s.nama_subkategori FROM subkategori as s";
	// Execute the query 
	$result = mysqli_query($con, $query);
	$result_k = mysqli_query($con, $query_k);
	if (!$result) {
		die("Could not query the database: <br />" . mysqli_error($con));
	}
	?>




	<!-- header -->
	<div class="navbar" id="main">
		<!-- logo pojok kiri atas -->
		<div class="logo">
			<a class="navbar-brand" href="#">
				<img id="logo" src="media/bob.jpg" class="rounded-circle align-self-center mr-3" alt="Bob">
				<h3 class="align-items-center" id="logo">Shopname</h3>
			</a>
		</div>

		<!-- Search form -->
		<div class="search">
			<!-- 
					<form class="form-inline">
						<div class="form w-75">
							<input class="form-control" type="text" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</div>
					</form> -->
			<div class="input-group mb-6 border rounded-pill p-1">
				<input type="search" placeholder="Search" aria-describedby="button-addon3" class="form-control bg-none border-0">
				<div class="input-group-append border-0">
					<button id="button-addon3" type="button" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>

		<!-- profil kanan atas -->
		<div class="profile">
			<img id="profile" src="media/bob.jpg" class="rounded-circle" alt="Bob">
		</div>
		<br>
		<!-- navbar atas -->
		<div class="navbar mx-auto" id="navbar-header">
			<?php
				$result_k = mysqli_query($con, $query_k);
				while ($row = mysqli_fetch_array($result_k)) {
					echo '<a href="#' . $row['nama_kategori'] . '">' . $row['nama_kategori'] . '</a>';
				}
				?>
		</div>
	</div>

	<!-- Main page -->
	<div class="row" id="contents">

		<!-- sidebar -->
		<div class="col-sm-2">

			<div class="sidebar">

				<hr class="divider">

				<h5> All Items</h5>
				<div class="sidebar" id="side-nav">
					<ul>
						<?php
							$result_s = mysqli_query($con, $query_s);
							while ($row = mysqli_fetch_array($result_s)) {
								echo '<li><a class="" href="#' . $row['nama_subkategori'] . '">' . $row['nama_subkategori'] . '</a></li>';
							}
							?>
					</ul>
				</div>

				<hr class="divider">

				<h5> Free Shipping </h5>
				<div class="side-text" id="shipping">
					<p> We offer you a free shipping option to 28 cities, if your order value is over Rp5.000.000,-.
						<br>
						For more information, please check
						<br>
						<a href="#">Free Shipping Information and Conditions</a>
					</p>
				</div>

				<hr class="divider">

				<h5>Delivery</h5>
				<div class="side-text" id="delivery">
					<p>
						We will notify you, when your order reach your destination.
					</p>
				</div>
			</div>
		</div>

		<!-- main contents -->
		<div class="col-sm-10">

			<div class="container-fluid">

				<!-- jumbotron -->
				<table>
				<tr>
				<td>
				<div class="image-detail">
					<img width="500px" height="auto" src="media/
					<?php
						while($row = mysqli_fetch_array($result)){
							echo $row['gambar_produk'];
							?>" alt="Gambar">



				</div>
				</td>
				<td>
				<div class="detail">
					<h1 id="lat"><?php
									echo $row['nama_produk'];
									?> </h1>

					<hr class="divider">

					<!-- placeholder konten -->
					<p align="justify">
						<?php
							echo  '>> <a>' . $row['nama_kategori'] . '</a> >> <a>' . $row['nama_subkategori'] . '</a>';
							echo '<h6 class="last-update">Terakhir diupdate tanggal: ' . $row['last_update'] . '</h6></br> </br>';
							echo '<b>Detail:</b></br></br>';
							echo $row['deskripsi'] . '</br></br></br>';
							if (!empty($row['stok'])){
								echo '<b>Stock:</b><h3 class="harga">' . $row['stok'] . ' Tersisa!</h3></br>';}
							else{
								echo '<b>Stock:</b><h3 class="harga">Habis!</h3></br>';
							}
							echo '<b>Harga:</b><h3 class="harga">Rp. ' . $row['harga'] . '</h3></br>';
							?>
					</p>

					<!-- button view all -->
					<?php
						if (!empty($row['stok'])){
								echo '<button class="btn btn-outline-primary"> Beli </button>';}
							else{
								echo '<button class="btn btn-outline-primary" disabled> Beli </button>';
							}
					?>
				</div>
				</td>
				</tr>
				</table>
			<?php
			}
			?>
			</div>

		</div>

	</div>

	<!-- footer -->
	<div class="footer">
		<br>
		<!-- navbar footer 1 -->
		<div class="navfoot">
			<a id="home" href="index.html">Home</a>
			<a href="#">About Us</a>
			<a href="#">Our Other Projects</a>
		</div>

		<hr class="divider">

		<!-- navbar footer 1 -->
		<div class="navfoot">
			<?php
				$result_k = mysqli_query($con, $query_k);
				while ($row = mysqli_fetch_array($result_k)) {
					echo '<a href="#' . $row['nama_kategori'] . '">' . $row['nama_kategori'] . '</a>';
				}
				?>
		</div>

		<div> © 2019 Copyright. All Rights Reserved. </div>
	</div>

</body>

</html>