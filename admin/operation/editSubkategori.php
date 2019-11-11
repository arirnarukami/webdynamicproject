<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "A"){
        header("location: login.php");
        exit;
    }
    
    $error1 = "";
    $error2 ="";   
    $error3 ="";   
    $id = $_GET['id'];

    // connect database 
	require_once('../db_login.php'); 
	$db = new mysqli($db_host, $db_username, $db_password, $db_database); 
	if ($db->connect_errno){  
		die ("Could not connect to the database: <br />". $db>connect_error); 
	} 

	if (!isset($_POST["submit"])){
        $query = " SELECT * FROM subkategori WHERE idsubkategori=".$id."";
        
        // Execute the query  
		$result = $db->query( $query );  
		if (!$result){   
			die ("Could not query the database: <br />". $db->error);  
		}else{   
			while ($row = $result->fetch_object()){   
                    $idkategori = $row->idkategori;
                    $name = $row->nama_subkategori;
            } 
        }  	   
	}else{
        $idkategori = test_input($_POST['idkategori']);
        if ($idkategori == ''){
            $error3 = 'Id Kategori harap diisi!';
            $valid3 = false;
        }
        else{
            $check = $db->query( 'SELECT * FROM kategori WHERE idkategori='.$idkategori );
            $result = $check->fetch_object();
            $row = $check->num_rows;
            if ($row == 0){
                $error3 = 'Id Kategori tidak ada, harap diganti!';
                $valid3 = false;
            }
            else{
                $error3 = '';
                $valid3 = true;
            }
        }
        $name = test_input($_POST['nama_subkategori']);  
        if ($name == ''){   
            $error2 = "Nama Sub Kategori harap diisi!";   
            $valid2 = FALSE;  
        }elseif (!preg_match("/^[a-zA-Z0-9 \/\-]*$/",$name)) 
        {        
            $error2 = "Hanya boleh diisi dengan huruf, angka, spasi, /, dan -";     
            $valid2 = FALSE;  
        }else{ 
            $error2="";
            $valid2 = TRUE;  
        }
        //update data into database  
	  	if ($valid2 && $valid3){   //escape inputs data   
	  		$idkategori = $db->real_escape_string($idkategori);   
	  		$name = $db->real_escape_string($name);    //Assign a query   
            $queryx = "UPDATE produk SET idkategori = ".$idkategori." WHERE idsubkategori = ".$id;
            $query = " UPDATE subkategori SET idkategori='".$idkategori."', nama_subkategori='".$name."' WHERE idsubkategori=".$id." ";   // Execute the query   
            $result = $db->query( $query );   
            $result2 = $db->query( $queryx );   
            if (!$result){      
                die ("Could not query the database: <br />". $db->error);   
            }elseif(!$result2){
                die ("Could not query the database: <br />". $db->error);   
            }
            else{
                $db->close();    
                header("location: ../admin_subkategori.php");
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
		<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
			<table>
                <tr>
                    <td valign="top">ID Sub Kategori</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="idsubkategori" size="30" maxlength="10" placeholder="ID Sub Kategori" autofocus value="<?php echo $id;?>" disabled></td>
                    <td valign="top"><span class="error">*  <?php echo $error1;?></span></td>
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
                    <td valign="top"><span class="error">*  <?php echo $error3;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Nama Sub Kategori</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="nama_subkategori" size="30" maxlength="50" placeholder="Name (max 50 characters)" autofocus value="<?php echo $name;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error2;?></span></td>
                </tr>
			</table>
            <td valign="top" colspan="3"><br><input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>
<?php
$db->close();
?>