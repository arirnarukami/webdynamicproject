<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <title>Admin Area</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/operator.css">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
    <link href="../../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../../fontawesome/css/brands.css" rel="stylesheet">
	<link href="../../fontawesome/css/solid.css" rel="stylesheet">
	 
	<style> 
	.error {color: #FF0000;} 
</style> 
</head>
<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <span class="navbar-brand" style="font-size: 25px;" href="#">
            <img src="../../media/corp.png" width="40px" alt="" style="margin-right: 10px"><b>Admin</b> Panel
        </span>
        <a href="../../logout.php" id="logout">Log Out</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="sidebar-sticky" id="menu">
                    <a href="../../admin.php">Dashboard</a>
                    <a href="../admin_kategori.php">Kategori</a>
                    <a href="../admin_subkategori.php">Sub Kategori</a>
                    <a href="../admin_produk.php">Produk</a>
                    <a href="../admin_pegawai.php">Pegawai</a>
                    <a href="editPegawai.php?id=<?php echo $_SESSION['id'];?>">Profil Saya</a>
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10" id="content">     
	<h1>Upload Gambar Produk</h1>
	<form action="upload.php?idproduk=<?php echo $_GET['idproduk']; ?>" method="post" enctype="multipart/form-data" />
	<div> File allowed : jpg, jpeg, png or gif<br /><br /> 
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<label for="userfile">Upload a file:</label> 
		<input type="file" name="userfile" id="userfile" /> 
		<input type="submit" value="Send File" /> 
	</div>
	</form>
</body>

</html>