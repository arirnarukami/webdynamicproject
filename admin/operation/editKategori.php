<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "A"){
        header("location: login.php");
        exit;
    }
    
    $error1 = "";
    $error2 ="";   
    $id = $_GET['id'];

    // connect database 
	require_once('../db_login.php'); 
	$db = new mysqli($db_host, $db_username, $db_password, $db_database); 
	if ($db->connect_errno){  
		die ("Could not connect to the database: <br />". $db>connect_error); 
	} 

	if (!isset($_POST["submit"])){
        $query = " SELECT * FROM kategori WHERE idkategori=".$id."";
        
        // Execute the query  
		$result = $db->query( $query );  
		if (!$result){   
			die ("Could not query the database: <br />". $db->error);  
		}else{   
			while ($row = $result->fetch_object()){  
                    $nama_kategori = $row->nama_kategori;
            } 
        }  	   
	}else{
        $name = test_input($_POST['nama_kategori']);  
        if ($name == ''){   
            $error2 = "Nama Kategori harap diisi!";   
            $valid2 = FALSE;  
        }elseif (!preg_match("/^[a-zA-Z0-9 \/\-]*$/",$name)) 
        {        
            $error2 = "Hanya boleh diisi dengan huruf, angka, spasi, /, dan -";     
            $valid2 = FALSE;  
        }else{ 
            $valid2 = TRUE;  
        }
        //update data into database  
	  	if ($valid2){   //escape inputs data     
	  		$name = $db->real_escape_string($name);    //Asign a query   
            $query = " UPDATE kategori SET  nama_kategori='".$name."' WHERE idkategori=".$id." ";   // Execute the query   
            $result = $db->query( $query );   
            if (!$result){      
                die ("Could not query the database: <br />". $db->error);   
            }else{
                $db->close();    
                header("location: ../admin_kategori.php");
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
                    <td valign="top">ID Kategori</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="idkategori" size="10" maxlength="10" placeholder="ID Kategori" autofocus value="<?php echo $id;?>" disabled></td>
                    <td valign="top"><span class="error">*  <?php echo $error1;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Nama Kategori</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="nama_kategori" size="30" maxlength="50" placeholder="Name (max 50 characters)" autofocus value="<?php echo $nama_kategori;?>"></td>
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