<?php
	if(($_GET['id'])==0){
		$a="";
	}else{
		$a="where k.idkategori=".$_GET['id'];
	}
	require_once('db_login.php');

	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()) {
		die("Could not connect to the database: <br />" .
			mysqli_connect_error());
	}
	$query_s = "SELECT distinct(s.idsubkategori),s.nama_subkategori FROM produk p join kategori k on p.idkategori=k.idkategori join subkategori s on p.idsubkategori=s.idsubkategori ".$a;
	
	$results = mysqli_query($con, $query_s);
	if (!$results) {
		die("Could not query the database: <br />" . mysqli_error($con));
	}
	
	echo '<button class="link" onClick="javascript:setProduk(0,0)">All in the Category</button><br>';
	while ($row = mysqli_fetch_array($results)) {
		echo '<button class="link" onClick="javascript:setProduk(0,'.$row['idsubkategori'].')">' . $row['nama_subkategori'] . '</button><br>';
	}
?>