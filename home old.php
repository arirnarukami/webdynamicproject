<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
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

	$query = "SELECT * FROM produk as p JOIN kategori as k ON p.idkategori=k.idkategori JOIN subkategori as sbk on p.idsubkategori=sbk.idsubkategori JOIN pegawai as peg on p.idpegawai= peg.idpegawai ";
	$query_k = "SELECT k.nama_kategori FROM kategori as k";
	$query_s = "SELECT s.nama_subkategori FROM subkategori as s";
	// Execute the query 
	$result = mysqli_query($con, $query);
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
	<div class="container-fluid">
		<div class="row" id="contents">

			<!-- sidebar -->
			<div class="col-sm-2">

				<div class="sidebar">

					<hr class="divider">

					<h5 id="pilih">All Items</h5>
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
				<div class="container">
					<div class="row">
						<?php
						while ($row = mysqli_fetch_array($result)) {
							//echo '<td><a href="customer/detail_customer.php?id='.$row->customerid.'">Detail</a> <a href="customer/edit_customer.php?id='.$row->customerid.'">  Edit  </a> <a href="customer/delete_customer.php?id='.$row->customerid.'">  Delete  </a></td>';  
							echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3  col-xl-3">';
							echo '<div class="card h-100">';
							echo '<a href="detail.php?id=' . $row['idproduk'] . '"><img class="card-img-top" src="media/' . $row['gambar_produk'] . '" alt="Gambar"></a>';
							echo '<div class="card-body">';
							echo '<h4 class="card-title">';
							echo '<a href="detail.php?id=' . $row['idproduk'] . '">' . $row['nama_produk'] . '</a></h4>';
							echo '<h5 class="harga">Rp.' . $row['harga'] . '</h5>';
							//echo '<p class="card-text" maxlength="10" >' . $row['deskripsi'] . '</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '<br>';
						}

						?>
					</div>
				</div>
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

		<!-- navbar footer 1 -->
		<hr class="divider">
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