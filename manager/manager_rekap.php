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

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <title>Manager Area</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../fontawesome/css/brands.css" rel="stylesheet">
    <link href="../fontawesome/css/solid.css" rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>		
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
            <div class="col-lg-10" id="content"><h1>Rekap Produk</h1>
				<?php
					// Include our login information 
					require_once('../db_login.php');
					// Connect 
					$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
					if (mysqli_connect_errno()) {
						die("Could not connect to the database: <br />" .
							mysqli_connect_error());
					}
					$query1 = "SELECT k.idkategori as kid, sb.idsubkategori as sbid, p.nama_produk
								FROM produk as p, kategori as k, subkategori sb
								WHERE p.idkategori = k.idkategori AND p.idsubkategori = sb.idsubkategori
								ORDER BY kid, sbid;";
					$query2 = "SELECT * FROM subkategori";
					$query3 = "SELECT * FROM kategori
								ORDER BY idkategori";
					//execute query
					$result1 = mysqli_query($con,$query1);
					$result2 = mysqli_query($con,$query2);
					$result3 = mysqli_query($con,$query3);
					if(!$result1 || !$result2 || !$result3){
						die("Query gagal");
					}
				?>
                <table border=1>
					<thead class="thead-dark">
							<tr>
							<!-- <th>No</th> -->
							<th>Kategori</th>
							<th>SubKategori</th>
							<th>Produk</th>
							</tr>
					</thead>
					<?php
					while ($row = mysqli_fetch_array($result3)){
						echo "<tr>";
						$totalkategori = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produk WHERE produk.idkategori= '{$row['idkategori']}'"));
						$adaberapasubkategoridikategoritersebut = mysqli_num_rows(mysqli_query($con, "SELECT * FROM subkategori WHERE subkategori.idkategori={$row['idkategori']}")); // akses cek subkategori ke kategori
						$i = 0;
						echo "<td rowspan='{$totalkategori}'>{$row["nama_kategori"]}</td>";
						while($row2 = mysqli_fetch_array($result2)){
							$totalsubkategori = mysqli_num_rows(mysqli_query($con, "SELECT * FROM produk WHERE produk.idsubkategori= '{$row2['idsubkategori']}'"));
							if($i == 0){
								echo "<td rowspan='{$totalsubkategori}'>{$row2["nama_subkategori"]}</td>";
							}else{
								echo '<tr>';
								echo "<td rowspan='{$totalsubkategori}'>{$row2["nama_subkategori"]}</td>";
								
							}
							$i++;

							$j = 0;
							while($row3 = mysqli_fetch_array($result1)){
								if($j == 0){
									echo '<td>'.$row3['nama_produk'].'</td>';
									echo '</tr>';
								}else{
									echo '<tr>';
									echo '<td>'.$row3['nama_produk'].'</td>';
									echo '</tr>';
								}
								$j++;
								if($j == $totalsubkategori)break;
							   
								
							}
							if($i == $adaberapasubkategoridikategoritersebut)break;
						}
					}
					?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>