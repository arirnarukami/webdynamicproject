<?php
session_start();
// connect database
require_once('../db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){  
	die ("Could not connect to the database: <br />". $db->connect_error); 
} 

if (isset($_POST["submit"])){  
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING); 
        $idkategori = filter_var($_POST['idkategori'],FILTER_SANITIZE_STRING);  
		$idsubkategori = filter_var($_POST['idsubkategori'],FILTER_SANITIZE_STRING);  
		$deskripsi = filter_var($_POST['deskripsi'],FILTER_SANITIZE_STRING); 
        $harga = filter_var($_POST['harga'],FILTER_SANITIZE_STRING);  
		$stok = filter_var($_POST['stok'],FILTER_SANITIZE_STRING);  
  		$error2 = NULL;
  		if ($name == ''){   
  			$error2 = "Nama Produk harap diisi";   
  		}  
        elseif (!preg_match("/^[A-Za-z ]*$/",$name)) {        
            $error2 = "Nama hanya boleh huruf dan spasi";     
        }
  		$error3 = NULL;
  		if ($idkategori == ''){   
  			$error3 = "ID Kategori harap diisi";   
  		}  
        elseif (!preg_match("/^[0-9 ]*$/",$idkategori)) {        
            $error3 = "Only number allowed";     
        }
  		$error4 = NULL;
  		if ($idsubkategori == ''){   
  			$error4 = "ID Sub Kategori harap diisi";   
  		}  
        elseif (!preg_match("/^[0-9 ]*$/",$idsubkategori)) {        
            $error4 = "Only number allowed";     
        }
  		$error5 = NULL;
  		if ($deskripsi == ''){   
  			$error5 = "deskripsi harap diisi";   
  		}
        $error6 = NULL;
        if ($harga == ''){   
            $error6 = "Harga harap diisi";   
        }elseif (!preg_match("/^[0-9]*$/",$harga)){ 
            $error6 = "Hanya boleh diisi dengan angka";
        }
        $error7 = NULL;
        if ($stok == ''){   
            $error7 = "Stok harap diisi";   
        }elseif (!preg_match("/^[0-9]*$/",$stok)){ 
            $error7 = "Hanya boleh diisi dengan angka";
        }
      

        
	  	if(!$error2 && !$error3 && !$error4 && !$error5 && !$error6 && !$error7){	     
            $iduser = $_SESSION['id'];
		  	$query = " INSERT INTO produk (nama_produk, idkategori, idsubkategori, deskripsi, harga, stok, last_update, idpegawai) VALUES ('$name','$idkategori','$idsubkategori','$deskripsi','$harga','$stok',now(),'$iduser')";   // Execute the query   
		  	$result = $db->query( $query );   
		  	if (!$result){      
		  		die ("Could not query the database: <br />". $db->error);   
		  	}else{
				$result2 = $db->query("SELECT * FROM produk ORDER BY idproduk DESC");
				$row = $result2->fetch_object();
                $db->close();      
                header("location: addProdukPhoto.php?idproduk=".$row->idproduk);
		  	}  
	  	}
	} 
	 	    function test_input($data) {    
		$data = trim($data);    
		$data = stripslashes($data);    
		$data = htmlspecialchars($data);    
		return $data; 
	} 

	?> 
	<!DOCTYPE HTML>  
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
		<style>
			.error {color: #FF0000;}
		</style>
		<script>
			function get_sub(){
			var idkategori = document.forms["form"]["idkategori"].value;
			<?php 
			$result = $db->query("SELECT * from kategori order by idkategori asc");
			echo 'if (idkategori == ""){document.getElementById("idsubkategori").innerHTML = '."'".'<option value="">--Select Subkategori--</option>'."';}";
			while ($row = $result->fetch_object()){
				echo 'if (idkategori == '.$row->idkategori.'){';
				echo 'document.getElementById("idsubkategori").innerHTML = ';
				$result2 = $db->query("SELECT * FROM subkategori where idkategori = ".$row->idkategori." order by idsubkategori asc");
				echo "'";
				while ($row2 = $result2->fetch_object()){
					echo '<option value="'.$row2->idsubkategori.'">'.$row2->nama_subkategori.'</option>';
				}
				echo "';}";
			}

			?>
		}
		</script>
</head> 
<body>  
	<nav class="navbar navbar-dark bg-dark sticky-top">
        <span class="navbar-brand" style="font-size: 25px;" href="#">
            <img src="../../media/corp.png" width="40px" alt="" style="margin-right: 10px">Tambah  Produk
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

	<form name="form" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> 
		<table>  
			<tr>   
				<td valign="top">Nama Produk</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="name" size="30" maxlength="50" placeholder="Nama Produk" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error2)) ? $error2 : '';?></span>
				</td>  
			</tr> 
			<tr>   
				<td valign="top">Kategori</td>   
				<td valign="top">:</td>   
				<td valign="top">
					<select name="idkategori" id="idkategori" onchange="get_sub()">
						<option value="">--Select Kategori--</option>
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
			<tr>   
				<td valign="top">Sub Kategori</td>   
				<td valign="top">:</td>   
				<td valign="top">
					<select name="idsubkategori" id="idsubkategori">
						<option value="">--Select Sub Kategori--</option>
					</select>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error4)) ? $error4 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Deskripsi</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <textarea name="deskripsi" id="deskripsi" rows="8" cols="50" autofocus></textarea>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error5)) ? $error5 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Harga</td>   
				<td valign="top">: Rp.</td>   
				<td valign="top">
                <input type="text" name="harga" size="30" maxlength="50" placeholder="Harga" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error6)) ? $error6 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Stok</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="stok" size="30" maxlength="50" placeholder="Stok Produk" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error7)) ? $error7 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top" colspan="3"><br>
				<input type="submit" name="submit" value="Submit" href="../admin_produk.php">  
			</tr>
			</table> 
		</form>
	</body> 
	</html> 
	<?php $db->close(); ?>