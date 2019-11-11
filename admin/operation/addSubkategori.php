<?php
// connect database
require_once('../db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){  
	die ("Could not connect to the database: <br />". $db>connect_error); 
} 

if (isset($_POST["submit"])){  
        $idkategori = filter_var($_POST['idkategori'],FILTER_SANITIZE_STRING); 
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);  
  		$error2 = NULL;
  		if ($name == ''){   
  			$error2 = "Nama Sub kategori harap diisi";   
  		}  
        elseif (!preg_match("/^[A-Za-z -\/.]*$/",$name)) {        
            $error2 = "Nama hanya boleh huruf, angka, -, /, dan .";     
        }
        $error3 = NULL;
  		if ($idkategori == ''){   
  			$error3 = "ID Kategori harap diisi";   
  		}
        else{
			$check = $db->query('SELECT idkategori FROM kategori WHERE idkategori = '.$idkategori);
			if($check->num_rows == 0){
            $error3 = "ID Kategori tidak ada";
			}
		}
          
	  	if(!$error2 && !$error3){	      
		  	$query = " INSERT INTO subkategori (idkategori,nama_subkategori) VALUES ('$idkategori','$name')";   // Execute the query   
		  	$result = $db->query( $query );   
		  	if (!$result){      
		  		die ("Could not query the database: <br />". $db->error);   
		  	}else{
                  $db->close();      
                header("location: ../admin_subkategori.php");
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
	<h2>Tambah Sub Kategori</h2> 
	<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> 
		<table>    
			<tr>   
				<td valign="top">Nama Sub Kategori</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="name" size="30" maxlength="50" placeholder="Nama Sub Kategori" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error2)) ? $error2 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Kategori</td>   
				<td valign="top">:</td>   
				<td valign="top">
					<select name="idkategori" id="idkategori">
						<?php 
							$result = $db->query("SELECT * from kategori order by idkategori asc");
							while ($row = $result->fetch_object()){
								echo '<option value="'.$row->idkategori.'">'.$row->nama_kategori.'</option>';
							}
						?>
					</select>
				</td>
				<td valign="top">
					<span class="error">* <?php echo (isset($error3)) ? $error3 : '';?></span>
				</td>  
			</tr>
			</table>
			<input type="submit" name="submit" value="Submit" href="../admin_subkategori.php">   
		</form>
	</body> 
	</html> 
	<?php $db->close(); ?>