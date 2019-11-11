<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "B"){
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
    <title>Manager Area</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <script type="text/javascript" src="chartjs/Chart.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <span class="navbar-brand" style="font-size: 25px;" href="#">
            <img src="media/corp.png" width="40px" alt="" style="margin-right: 10px"><b>Manager</b> Panel
        </span>
        <a href="logout.php" id="logout">Log Out</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="sidebar-sticky" id="menu">
                    <a href="manager.php">Grafik Data Produk</a>
                    <a href="manager/manager_produk.php">Produk</a>
                    <a href="manager/manager_rekap.php">Rekap Data Produk</a>
                    <a href="manager/editManager.php?id=<?php echo $_SESSION['id'];?>">Edit Profil</a>
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10" id="content">
                <h1>Informasi</h1>
                <div class="row info">
                    <div class ="infobox" >
                        <?php
                            $query = "SELECT * FROM kategori";
                            $result = $mysqli->query($query);
                            if (!$result){
                                die ("Could not query the database: <br />". $db->error);
                            }
                            echo '<p>Jumlah Kategori</p>';
                            echo '<p id="jumkat">'.$result->num_rows.'</p>';
                        ?>
                    </div>
                    <div class ="infobox">
                        <?php
                            $query = "SELECT * FROM subkategori";
                            $result = $mysqli->query($query);
                            if (!$result){
                                die ("Could not query the database: <br />". $db->error);
                            }
                            echo '<p>Jumlah Sub Kategori</p>';
                            echo '<p id="jumskat">'.$result->num_rows.'</p>';
                        ?>
                    </div>
                    <div class ="infobox">
                        <?php
                            $query = "SELECT * FROM produk";
                            $result = $mysqli->query($query);
                            if (!$result){
                                die ("Could not query the database: <br />". $db->error);
                            }
                            echo '<p>Jumlah Produk</p>';
                            echo '<p id="jumpro">'.$result->num_rows.'</p>';
                        ?>
                    </div>
                </div>
                <br />
                <h2> Grafik Produk per Kategori </h2>

                <div style="width: 800px;margin: 0px auto;">
                    <canvas id="myChart"></canvas>
                </div>

                <br/>
                <br/>
                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                            <?php
                                $kategori = $mysqli->query("select nama_kategori from kategori");
                                $row = $kategori->fetch_object();
                                echo '"'.$row->nama_kategori.'"';
                                while ($row = $kategori->fetch_object()){
                                    echo ',';
                                    echo '"'.$row->nama_kategori.'"';
                                }
                            ?>]
                            ,
                            datasets: [{
                                label: '',
                                data: [
                                    <?php
                                        $jum = $mysqli->query("SELECT count(idproduk) as jumlah FROM produk GROUP BY idkategori ORDER BY idkategori");
                                        $row = $jum->fetch_object();
                                        echo '"'.$row->jumlah.'"';
                                        while ($row = $jum->fetch_object()){
                                            echo ',';
                                            echo '"'.$row->jumlah.'"';
                                        }
                                    ?>
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 17, 112, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 17, 112, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>
<?php
    $result->free();
    $mysqli->close();
?>
</html>
