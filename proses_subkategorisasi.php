<?php
	if($_GET['ids']==0){
		if($_GET['id']!=0){
			$a="where k.idkategori=".$_GET['id'];
		}else{
			$a="";
		}
	}else if($_GET['ids']!=0){
		$a="where s.idsubkategori=".$_GET['ids'];
	}
	require_once('db_login.php');

	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()) {
		die("Could not connect to the database: <br />" .
			mysqli_connect_error());
	}
	$query = "SELECT * FROM produk as p JOIN kategori as k ON p.idkategori=k.idkategori JOIN subkategori as s on p.idsubkategori=s.idsubkategori JOIN pegawai as peg on p.idpegawai= peg.idpegawai ".$a." Group by p.idproduk";
	
	$result = mysqli_query($con, $query);
	if (!$result) {
		die("Could not query the database: <br />" . mysqli_error($con));
	}
	
	function rupiah($angka){
		return $angka = "Rp " . number_format($angka,0,',','.');
	}
	
	while ($row = mysqli_fetch_array($result)) {
		//echo '<td><a href="customer/detail_customer.php?id='.$row->customerid.'">Detail</a> <a href="customer/edit_customer.php?id='.$row->customerid.'">  Edit  </a> <a href="customer/delete_customer.php?id='.$row->customerid.'">  Delete  </a></td>';  
		echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3  col-xl-3">';
		echo '<div class="card h-100">';
		echo '<a href="detail.php?id=' . $row['idproduk'] . '"><img class="card-img-top" src="media/' . $row['gambar_produk'] . '" alt="Gambar"></a>';
		echo '<div class="card-body">';
		echo '<h4 class="card-title">';
		echo '<a href="detail.php?id=' . $row['idproduk'] . '">' . $row['nama_produk'] . '</a></h4>';
		echo '<h5 class="harga">' .rupiah($row['harga']) . '</h5>';
		//echo '<p class="card-text" maxlength="10" >' . $row['deskripsi'] . '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<br>';
	}
?>