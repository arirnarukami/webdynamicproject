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
            <div class="col-lg-10" id="content">
                <h1>Kategori</h1>
                <a type="button" class="btn btn-light" href="operation/addKategori.php">+ Tambah Kategori</a>
                <table border=1>
                    <tr>
                        <th class="no">No.</th>
                        <th class="id">ID Kategori</th>
                        <th class="nama">Nama Kategori</th>
                        <th class="ops"></th>
                    </tr>
                    <?php
                        $query = "SELECT * FROM kategori ORDER BY idkategori ASC";
                        $result = $mysqli->query($query);
                        if (!$result){
                            die ("Could not query the database: <br />". $db->error);
                        }
                        $i = 1;
                        while($row = $result->fetch_object()){
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$row->idkategori.'</td> ';
                            echo '<td>'.$row->nama_kategori.'</td> ';
                            echo '<td class="ops"><a href="operation/editKategori.php?id='.$row->idkategori.'"><i class="fas fa-edit"></i></a><a href="operation/delete.php?id='.$row->idkategori.'&ops=1"><i class="fas fa-trash"></i></a></td>';
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
