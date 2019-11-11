<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "A"){
        header("location: login.php");
        exit;
    }
    
    $error1 ="";
    $error2 =""; 
    $error3 ="";
    $error4 =""; 
    $error5 ="";
    $error6 =""; 
    $error7 ="";
    $id = $_GET['id'];
    $iduser = $_SESSION['id'];

    // connect database 
	require_once('../db_login.php'); 
	$db = new mysqli($db_host, $db_username, $db_password, $db_database); 
	if ($db->connect_errno){  
		die ("Could not connect to the database: <br />". $db>connect_error); 
	} 

	if (!isset($_POST["submit"])){
        $query = " SELECT * FROM produk WHERE idproduk=".$id."";
        
        // Execute the query  
		$result = $db->query( $query );  
		if (!$result){   
			die ("Could not query the database: <br />". $db->error);  
		}else{   
			while ($row = $result->fetch_object()){   
                    $deskripsi = $row->deskripsi;
                    $harga = $row->harga;
                    $idkategori = $row->idkategori;
                    $idsubkategori = $row->idsubkategori;
                    $name = $row->nama_produk;
                    $stok = $row->stok;

            } 
        }  	   
	}else{
        $name = test_input($_POST['nama_produk']);  
        if ($name == ''){   
            $error2 = "Nama Produk harap diisi!";   
            $valid2 = FALSE;  
        }elseif (!preg_match("/^[a-zA-Z0-9 \/\-]*$/",$name)) 
        {        
            $error2 = "Hanya boleh diisi dengan huruf, angka, spasi, /, dan -";     
            $valid2 = FALSE;  
        }else{ 
            $valid2 = TRUE;  
        }
        $kategori = test_input($_POST['idkategori']);  
        if ($kategori == ''){   
            $error3 = "ID Kategori harap diisi!";   
            $valid3 = FALSE;  
        }elseif (!preg_match("/^[0-9]{1}$/",$kategori)) 
        {        
            $error3 = "Hanya boleh diisi 1 angka";     
            $valid3 = FALSE;  
        }else{ 
            $valid3 = TRUE;  
        }
        $subkategori = test_input($_POST['idsubkategori']);  
        if ($subkategori == ''){   
            $error4 = "ID Sub Kategori harap diisi!";   
            $valid4 = FALSE;  
        }elseif (!preg_match("/^[0-9]{2}$/",$subkategori)) 
        {        
            $error4 = "Hanya boleh diisi 2 angka, terdiri dari Id Kategori+Id Sub Kategori";     
            $valid4 = FALSE;  
        }else{ 
            $valid4 = TRUE;  
        }
        $deskripsi = test_input($_POST['deskripsi']);  
        if ($deskripsi == ''){   
            $error5 = "ID Sub Kategori harap diisi!";   
            $valid5 = FALSE;  
        }else{ 
            $valid5 = TRUE;  
        }
        $harga = test_input($_POST['harga']);  
        if ($harga == ''){   
            $error6 = "Harga harap diisi!";   
            $valid6 = FALSE;  
        }elseif (!preg_match("/^[0-9,.]*$/",$kategori)) 
        {        
            $error6 = "Hanya boleh diisi angka, ',', dan '.' ";     
            $valid6 = FALSE;  
        }else{ 
            $valid6 = TRUE;  
        }
        $stok = test_input($_POST['stok']);  
        if ($stok == ''){   
            $error7 = "Stok harap diisi!";   
            $valid7 = FALSE;  
        }elseif (!preg_match("/^[0-9]*$/",$kategori)) 
        {        
            $error7 = "Hanya boleh diisi angka";     
            $valid7 = FALSE;  
        }else{ 
            $valid7 = TRUE;  
        }
        //update data into database  
	  	if ($valid2 && $valid3 && $valid4 && $valid5 && $valid6 && $valid7){   //escape inputs data    
	  		$deskripsi = $db->real_escape_string($deskripsi);   
	  		$harga = $db->real_escape_string($harga);   
	  		$idkategori = $db->real_escape_string($kategori);   
	  		$idsubkategori = $db->real_escape_string($subkategori);   
	  		$stok = $db->real_escape_string($stok);   
	  		$name = $db->real_escape_string($name);    //Assign a query   
            $query = " UPDATE produk SET deskripsi='".$deskripsi."', harga='".$harga."', idkategori='".$idkategori."', idsubkategori='".$idsubkategori."', stok='".$stok."', nama_produk='".$name."', harga='".$harga."', last_update=now(), idpegawai='".$_SESSION["id"]."' WHERE idproduk=".$id." ";   // Execute the query   
            $result = $db->query( $query );   
            if (!$result){      
                die ("Could not query the database: <br />". $db->error);   
            }else{
                $db->close();    
                header("location: ../admin_produk.php");
                exit;   
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
        <h2>Edit Kategori</h2>
        <h4>Detail Produk</h4>
		<form name="form" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
			<table>
                <tr>
                    <td valign="top">ID Produk</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="idproduk" size="10" maxlength="10" placeholder="ID Produk" autofocus value="<?php echo $id;?>" disabled></td>
                    <td valign="top"><span class="error">*  <?php echo $error1;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Nama Produk</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="nama_produk" size="30" maxlength="50" placeholder="Nama Produk" autofocus value="<?php echo $name;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error2;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Kategori</td>
                    <td valign="top">:</td>
                    <td valign="top"><select name="idkategori" id="idkategori" onchange="get_sub()">
						<option value="">--Select Kategori--</option>
						<?php 
							$result = $db->query("SELECT * from kategori order by idkategori asc");
							while ($row = $result->fetch_object()){
								echo '<option value="'.$row->idkategori.'">'.$row->nama_kategori.'</option>';
							}
						?>
					</select></td>
                    <td valign="top"><span class="error">*  <?php echo $error3;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Sub Kategori</td>
                    <td valign="top">:</td>
                    <td valign="top"><select name="idsubkategori" id="idsubkategori">
						<option value="">--Select Sub Kategori--</option>
					</select></td>
                    <td valign="top"><span class="error">*  <?php echo $error4;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Deskripsi</td>
                    <td valign="top">:</td>
                    <td valign="top"><textarea rows="6" cols="30" name="deskripsi" id="deskripsi"><?php echo $deskripsi;?></textarea></td>
                    <td valign="top"><span class="error">*  <?php echo $error5;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Harga</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="harga" size="30" maxlength="50" placeholder="Harga" autofocus value="<?php echo $harga;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error6;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Stok</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="stok" size="30" maxlength="50" placeholder="Stok" autofocus value="<?php echo $stok;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error7;?></span></td>
                </tr>
			</table>
            <td valign="top" colspan="3"><br><input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>
<?php
$db->close();
?>