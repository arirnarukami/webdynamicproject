<?php
session_start();
// connect database
require_once('../db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){  
	die ("Could not connect to the database: <br />". $db>connect_error); 
} 

if (isset($_POST["submit"])){   
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING); 
        $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);  
		$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);  
		$repassword = filter_var($_POST['repassword'],FILTER_SANITIZE_STRING); 
        $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);  
		$level = filter_var($_POST['level'],FILTER_SANITIZE_STRING);  
  		$error2 = NULL;
  		if ($name == ''){   
  			$error2 = "Nama Pegawai harap diisi";   
  		}  
        elseif (!preg_match("/^[A-Za-z ]*$/",$name)) {        
            $error2 = "Nama hanya boleh huruf dan spasi";     
        }
  		$error3 = NULL;
  		if ($username == ''){   
  			$error3 = "Username harap diisi";   
  		}  
        elseif (!preg_match("/^[a-z0-9 ]*$/",$username)) {        
            $error3 = "username hanya boleh huruf kecil , angka, dan spasi";     
        }
  		$error4 = NULL;
  		$error5 = NULL;
  		if ($password == ''){   
  			$error4 = "Password harap diisi";   
        }
        elseif ($repassword == ''){
            $error5 = "Repassword harap diisi";   
        }  
        elseif ($password != $repassword) {        
            $error4 = "Password dan repassword berbeda, harap isi kembali";     
        }
  		$error6 = NULL;
  		if ($email == ''){   
  			$error6 = "email harap diisi";   
  		}elseif (!preg_match("/^[a-zA-Z0-9._-]*+@[a-z]*+\.[a-zA-Z]*$/",$email)){        
            $error6 = "format email salah";     
        }
        $error7 = NULL;
        if ($level == ''){   
            $error7 = "Level User harap diisi";   
        }elseif (!preg_match("/^[a-bA-B]{1}$/",$level)){ 
            $error7 = "Hanya boleh diisi dengan huruf A sebagai Admin atau B sebagai Manajer";
        }
      

        
	  	if(!$error2 && !$error3 && !$error4 && !$error5 && !$error6 && !$error7){	      
		  	$query = " INSERT INTO pegawai (nama_lengkap, username, password, email, level) VALUES ('$name','$username','$password','$email','$level')";   // Execute the query   
		  	$result = $db->query( $query );   
		  	if (!$result){      
		  		die ("Could not query the database: <br />". $db->error);   
		  	}else{
                $db->close();      
                header("location: ../admin_pegawai.php");
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

	<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"> 
		<table>  
			<tr>   
				<td valign="top">Nama Pegawai</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="name" size="30" maxlength="50" placeholder="Nama Pegawai" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error2)) ? $error2 : '';?></span>
				</td>  
			</tr> 
			<tr>   
				<td valign="top">Username</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="username" size="30" maxlength="50" placeholder="Username" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error3)) ? $error3 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Password</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="password" name="password" size="30" maxlength="50" placeholder="Password" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error4)) ? $error4 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">RePassword</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="password" name="repassword" size="30" maxlength="50" placeholder="RePassword" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error5)) ? $error5 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Email</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="email" size="30" maxlength="50" placeholder="Email" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error6)) ? $error6 : '';?></span>
				</td>  
			</tr>
			<tr>   
				<td valign="top">Level User</td>   
				<td valign="top">:</td>   
				<td valign="top">
                <input type="text" name="level" size="30" maxlength="50" placeholder="Level User" autofocus>
				</td>   
				<td valign="top">
					<span class="error">* <?php echo (isset($error7)) ? $error7 : '';?></span>
				</td>  
			</tr>
			</table> 
				<input type="submit" name="submit" value="Submit" href="../admin_pegawai.php">  
		</form>
            </div>
        </div>
    </div>
</body>
</html>
<?php $db->close();?>