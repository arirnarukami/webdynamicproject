<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["level"] !== "B"){
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

    // connect database 
	require_once('../db_login.php'); 
	$db = new mysqli($db_host, $db_username, $db_password, $db_database); 
	if ($db->connect_errno){  
		die ("Could not connect to the database: <br />". $db>connect_error); 
	} 

	if (!isset($_POST["submit"])){
        $query = " SELECT * FROM pegawai WHERE idpegawai=".$id."";
        
        // Execute the query  
		$result = $db->query( $query );  
		if (!$result){   
			die ("Could not query the database: <br />". $db->error);  
		}else{   
			while ($row = $result->fetch_object()){   
                    $idpegawai = $row->idpegawai;
                    $nama_lengkap = $row->nama_lengkap;
                    $email = $row->email;
                    $username = $row->username;
                    $password = $row->password;
                    $level = $row->level;
            } 
        }  	   
	}else{
        $idpegawai = test_input($_POST['idpegawai']);
        if ($idpegawai == ''){
            $error1 = 'Id Pegawai harap diisi!';
            $valid1 = false;
        }
        else{
            $check = $db->query( 'SELECT * FROM pegawai WHERE idpegawai='.$idpegawai );
            $result = $check->fetch_object();
            $row = $check->num_rows;
            if (($row >= 1)  && (($result->idpegawai) != $idpegawai)){
                $error1 = 'Id Pegawai sudah ada, harap diganti!';
                $valid1 = false;
            }
            else{
                $error1 = '';
                $valid1 = true;
            }
        }
        $name = test_input($_POST['nama_lengkap']);  
        if ($name == ''){   
            $error2 = "Nama Pegawai harap diisi!";   
            $valid2 = FALSE;  
        }elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) 
        {        
            $error2 = "Hanya boleh diisi dengan huruf, dan spasi";     
            $valid2 = FALSE;  
        }else{ 
            $valid2 = TRUE;  
			$nama_lengkap = $name;
        }
        $email = test_input($_POST['email']);  
        if ($email == ''){   
            $error3 = "Email harap diisi!";   
            $valid3 = FALSE;  
        }elseif (!preg_match("/^[a-zA-Z0-9._-]*+@[a-z]*+\.[a-zA-Z]*$/",$email)) 
        {        
            $error3 = "Format email salah";     
            $valid3 = FALSE;  
        }else{ 
            $valid3 = TRUE;  
        }
        $username = test_input($_POST['username']);  
        if ($username == ''){   
            $error4 = "Username harap diisi!";   
            $valid4 = FALSE;  
        }elseif (!preg_match("/^[a-z0-9]*$/",$username)) 
        {        
            $error4 = "Hanya boleh diisi dengan huruf kecil dan angka";     
            $valid4 = FALSE;  
        }else{ 
            $valid4 = TRUE;  
        }
        $password = test_input($_POST['password']);
        $repassword = test_input($_POST['repassword']);  
        if ($password == ''){   
            $error5 = "Password harap diisi!";   
            $valid5 = FALSE;  
        }elseif ($repassword == ''){   
            $error6 = "RePassword harap diisi!";   
            $valid6 = FALSE;
        }else if ($password != $repassword){ 
            $valid6 = "Repassword berbeda dengan Password, masukkan password kembali.";  
            $valid6 = FALSE;
        }
        else {
            $valid5 = TRUE;
            $valid6 = TRUE;
        }
        $level = test_input($_POST['level']);
        if ($level == ''){   
            $error7 = "Level user harap diisi!";   
            $valid7 = FALSE;  
        }elseif (!preg_match("/^[a-bA-B]{1}$/",$level)) 
        {        
            $error7 = "Hanya boleh diisi dengan huruf B sebagai Manager atau B sebagai Manager";     
            $valid7 = FALSE;  
        }else{ 
            $valid7 = TRUE;  
        } 


        //update data into database  
	  	if ($valid1 && $valid2 && $valid3 && $valid4 && $valid5 && $valid6 && $valid7){   //escape inputs data   
	  		$idpegawai = $db->real_escape_string($idpegawai);   
	  		$name = $db->real_escape_string($name);
	  		$email = $db->real_escape_string($email);   
	  		$username = $db->real_escape_string($username);
	  		$password = $db->real_escape_string($password);   
	  		$level = $db->real_escape_string($level);    //Asign a query   
            $query = " UPDATE pegawai SET idpegawai='".$idpegawai."', nama_lengkap='".$name."', email='".$email."', username='".$username."', password='".$password."', level='".$level."' WHERE idpegawai=".$id." ";   // Execute the query   
            $result = $db->query( $query );   
            if (!$result){      
                die ("Could not query the database: <br />". $db->error);   
            }else{    
                echo 'Data has been updated.<br /><br />';
                echo '<a href="../manager.php">Kembali</a>';
                $db->close();    
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
<!DOCTYPE HTML>
<html>
	
	<head>
	
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <title>Manager Area</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/operator.css">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../fontawesome/css/brands.css" rel="stylesheet">
    <link href="../fontawesome/css/solid.css" rel="stylesheet">
	
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
            <div class="col-lg-10" id="content">
			
			
        <h2>Edit Pegawai</h2>
		<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
			<table>
                <tr>
                    <td valign="top">ID Pegawai</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="idpegawai" size="30" maxlength="10" placeholder="ID Pegawai" autofocus value="<?php echo $idpegawai;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error1;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Nama Pegawai</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="nama_lengkap" size="30" placeholder="Nama Lengkap" autofocus value="<?php echo $nama_lengkap;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error2;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Email</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="email" size="30" maxlength="50" placeholder="email" autofocus value="<?php echo $email;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error3;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Username</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="username" size="30" maxlength="50" placeholder="username" autofocus value="<?php echo $username;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error4;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Password</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="password" name="password" size="30" maxlength="50" placeholder="password" autofocus value=""></td>
                    <td valign="top"><span class="error">*  <?php echo $error5;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Re-Password</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="password" name="repassword" size="30" maxlength="50" placeholder="repassword" autofocus value=""></td>
                    <td valign="top"><span class="error">*  <?php echo $error5;?></span></td>
                </tr>
                <tr>
                    <td valign="top">Level User</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="text" name="level" size="30" maxlength="1" placeholder="level user" autofocus value="<?php echo $level;?>"></td>
                    <td valign="top"><span class="error">*  <?php echo $error6;?></span></td>
                </tr>
				
					
			
			</table>
			<br><input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>
<?php
$db->close();
?>