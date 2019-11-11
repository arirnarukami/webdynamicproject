<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "A"){
        header("location: login.php");
        exit;
    }

    require_once "db_login.php";
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
            <img src="../media/corp.png" width="40px" alt="" style="margin-right: 10px"><b>Admin</b> Panel
        </span>
        <a href="../logout.php" id="logout">Log Out</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="sidebar-sticky" id="menu">
                    <a href="../admin.php">Dashboard</a>
                    <a href="admin_kategori.php">Kategori</a>
                    <a href="admin_subkategori.php">Sub Kategori</a>
                    <a href="admin_produk.php">Produk</a>
                    <a href="admin_pegawai.php">Pegawai</a>
                    <a href="operation/editPegawai.php?id=<?php echo $_SESSION['id'];?>">Profil Saya</a>
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10" id="content"><h1>Produk</h1>
                <a type="button" class="btn btn-light" href="operation/addProduk.php">+ Tambah Produk</a>
                <table border=1>
                    <tr>
                        <th class="no">No.</th>
                        <th class="id">ID Produk</th>
                        <th class="nama">Nama Produk</th>
                        <th class="bq">Updated</th>
                        <th class="images">Gambar Produk</th>
                        <th class="ops"></th>
                    </tr>
                    <?php
                        $query = "SELECT * FROM produk";
                        $result = $mysqli->query($query);
                        if (!$result){
                            die ("Could not query the database: <br />". $mysqli->error);
                        }
                        $i = 1;
                        while($row = $result->fetch_object()){
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$row->idproduk.'</td> ';
                            echo '<td><a style="text-decoration:none;color:inherit" href="operation/detail.php?id='.$row->idproduk.'">'.$row->nama_produk.'</td> ';
                            echo '<td>'.$row->last_update.'</td> ';
                            echo '<td><a href="operation/editProdukPhoto.php?idproduk='.$row->idproduk.'"><img src="../media/'.$row->gambar_produk.'" width=100px></a></td> ';
                            echo '<td class="ops"><a href="operation/editProduk.php?id='.$row->idproduk.'"><i class="fas fa-edit"></i></a><a href="operation/delete.php?id='.$row->idproduk.'&ops=3"><i class="fas fa-trash"></i></a></td>';
                            echo '</tr>';
                            $i++;
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
