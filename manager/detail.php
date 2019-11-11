<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "B"){
        header("location: login.php");
        exit;
    }

    require_once "../db_login.php";
    $mysqli = new mysqli($db_host, $db_username, $db_password, $db_database);
             
    // Cek koneksi
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <title>Admin Area</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../fontawesome/css/brands.css" rel="stylesheet">
    <link href="../fontawesome/css/solid.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <span class="navbar-brand" style="font-size: 25px;" href="#">
            <img src="../media/corp.png" width="40px" alt="" style="margin-right: 10px"><b>Manager</b> Panel
        </span>
        <a href="../logout.php" id="logout">Log Out</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="sidebar-sticky" id="menu">
                    <a href="../manager.php">Grafik Data Produk</a>
                    <a href="manager_produk.php">Produk</a>
                    <a href="manager_rekap.php">Rekap Data Produk</a>
                    <a href="editManager.php?id=<?php echo $_SESSION['id'];?>">Edit Profil</a>
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10" id="content"><h1>Detail Produk</h1>
                <table id="detailtable">
                    <?php
                        $query = "SELECT p.idproduk as idproduk, p.nama_produk as nama_produk, p.deskripsi as deskripsi, p.gambar_produk as gambar_produk, p.harga as harga, p.last_update as last_update, p.idpegawai as idpegawai, p.stok as stok, k.nama_kategori as nama_kategori, s.nama_subkategori as nama_subkategori, g.nama_lengkap as nama_pegawai FROM produk p JOIN subkategori s ON p.idsubkategori = s.idsubkategori JOIN kategori k ON k.idkategori = p.idkategori JOIN pegawai g ON p.idpegawai = g.idpegawai WHERE idproduk=".$_GET['id'];
                        $result = $mysqli->query($query);
                        if (!$result){
                            die ("Could not query the database: <br />". $mysqli->error);
                        }
                        while($row = $result->fetch_object()){
                            echo '<tr>';
                            echo '<td>ID Produk</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->idproduk.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Sub Kategori</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->nama_subkategori.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Kategori</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->nama_kategori.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Nama Produk</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->nama_produk.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Deskripsi</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->deskripsi.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Harga</td>';
                            echo '<td>:</td>';
                            echo '<td>Rp.'.$row->harga.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Stock Produk</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->stok.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Update Terakhir</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->last_update.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Update oleh</td>';
                            echo '<td>:</td>';
                            echo '<td>'.$row->nama_pegawai.'</td> ';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Gambar Produk</td>';
                            echo '<td>:</td>';
                            echo '<td><img src="../media/'.$row->gambar_produk.'" width=200px></td> ';
                        }
                        $result->free();
				        $mysqli->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

                        