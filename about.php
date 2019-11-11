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
	<script src="js/ajax2.js" type="text/javascript"></script>
	<!-- css sheet -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
	 button.link { 
		 background: none;
		 border: none; 
		}

button.link:hover {
	background: none;
	border: none;
	color: magenta
}

button.links {
	background: none;
	border: none;
}

button.links:hover {
	background: none;
	border: none;
	color: white;
	background-color: blue;
}
button.links2 {
	background: none;
	border: none;
	color:white;
}

button.links2:hover {
	background: none;
	border: none;
	background-color: gray;
}
	</style>
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

	$query_k = "SELECT * FROM kategori";

	// Execute the query 
	$resultk = mysqli_query($con, $query_k);
	if (!$resultk) {
		die("Could not query the database: <br />" . mysqli_error($con));
	}						
	?>




	<!-- header -->
	<div class="navbar" id="main">
		<!-- logo pojok kiri atas -->
		<div class="logo col-sm-3">
			<a class="navbar-brand" href="home.php">
				<img id="logo" src="media/icon.png" class="rounded-circle align-self-center mr-3" alt="Bob">
				<h3 class="align-items-center" id="logo-name" href="home.php">IT Mart</h3>
			</a>
		</div>

		<!-- Search form -->
		<div class="search col-sm-8">
			<!-- 
					<form class="form-inline">
						<div class="form w-75">
							<input class="form-control" type="text" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</div>
					</form>
			<div class="input-group mb-6 border rounded-pill p-1">
			<input id="cari" type="search" placeholder="Search" aria-describedby="button-addon3" class="form-control bg-none border-0" onkeyup="javascript:setCari()">
				<div class="input-group-append border-0">
					<button id="button-addon3" type="button" class="btn btn-link text-success" onClick="javascript:setCari()"><i class="fa fa-search"></i></button>
				</div>
			</div>-->
		</div>

		<!-- profil kanan atas -->
		<div class="profile col-sm-1">
			<a href="login.php"><img id="profile" src="media/akun.jpg" class="rounded-circle" alt="Bob"></a>
		</div>
		<br>
		<!-- navbar atas -->
		<div class="navbar mx-auto" id="navbar-header">
		
		</div>
	</div>

	<!-- Main page -->
	<div class="container-fluid">
		<div class="row" id="contents">

			<!-- sidebar -->
			<div class="col-sm-1">

				<!--<div class="sidebar">

					<hr class="divider">

					<h5 id="pilih">Sub Categories</h5>
					<div class="sidebar" id="side-nav">

						
						
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
				</div>-->
			</div>

			<!-- main contents -->
			<div class="col-sm-10">
				<div class="container">
			<div id="team">
				<h1 class="subtitle white">Meet The Team</h1>
				<hr class="divider1">
				<div class="row" style="width:75vw; margin-top: 25px; margin-left:auto; margin-right:auto">
				  <div class="col-lg-4">
					<img class="face" id="arir" src="media/arir.jpg" alt="face">
					<div class="desc">
						<h3>Syahrir A. Muharram</h3>
						<p>24060117130063</p>
					</div>
				  </div>
				  <div class="col-lg-4">
					<img class="face" id="johan" src="media/johan.jpg" alt="face">
					<div class="desc">
						<h3>Johanadi Santoso</h3>
						<p>24060117120001</p>
					</div>
				  </div>
				  <div class="col-lg-4">
					<img class="face" id="arya" src="media/arya.jpg" alt="face">
					<div class="desc">
						<h3>Mohamad Aryarafi D.</h3>
						<p>24060117140092</p>
					</div>
				  </div>
				</div>								
				<div class="row" style="width:75vw; margin-top:25px; margin-left:auto; margin-right:auto">
				  <div class="col-lg-1"></div>
					<div class="col-lg-5">
						<a name="#ainun"></a>
						<img class="face" id="ainun" src="media/ainun.jpg" alt="face">
						<div class="desc">
							<h3>Ahmad Ainun H.</h3>
							<p>24060117120027</p>
						</div>
					</div>
					<div class="col-lg-5">
						<a name="#syaiful"></a>
						<img class="face" id="syaiful" src="media/ipul.jpg" alt="face">
						<div class="desc">
							<h3>Rizky Syaiful F.</h3>
							<p>24060117130052</p>
						</div>
					 </div>
				</div>
			</div>
			</div>					
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footers">
		<br>
		<!-- navbar footer 1 -->
		<div class="navfoot">
			<a id="home" href="home.php">Home</a>
			<a href="about.php">About Us</a>
		</div>

		<!-- navbar footer 1 -->
		<hr class="divider">
		<div class="navfoot">
		</div>

		<div> © 2019 Copyright. All Rights Reserved. </div>
	</div>

</body>

</html>