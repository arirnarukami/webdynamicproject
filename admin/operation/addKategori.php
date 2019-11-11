<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "A"){
        header("location: login.php");
        exit;
    }
// connect database
require_once('../db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){  
	die ("Could not connect to the database: <br />". $db>connect_error); 
} 

if (isset($_POST["submit"])){    
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);  
  		$error2 = NULL;
  		if ($name == ''){   
  			$error2 = "Nama kategori harap diisi";   
  		}  
        elseif (!preg_match("/^[A-Za-z -\/.]*$/",$name)) {        
            $error2 = "Nama hanya boleh huruf, angka, -, /, dan .";     
        }
          
	  	if(!$error2){	      
		  	$query = " INSERT INTO kategori (nama_kategori) VALUES ('$name')";   // Execute the query   
		  	$result = $db->query( $query );   
		  	if (!$result){      
		  		die ("Could not query the database: <br />". $db->error);   
		  	}else{
                $db->close();
                header("location: ../admin_kategori.php");
		  	}  
	  	}
	}
?>
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
			<h2>Tambah Kategori</h2> 
	<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> 
		<table>   
			<tr>   
				<td valign="top">Nama Kategori</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="name" size="30" maxlength="50" placeholder="Nama Kategori" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error2)) ? $error2 : '';?></span>
				</td>  
			</tr>
			</table> 
			<input type="submit" name="submit" value="Submit" href="../admin_kategori.php">  
		</form>
            </div>
        </div>
    </div>
</body>
</html>
<?php $db->close();?>