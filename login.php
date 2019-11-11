<?php
// Inisialisasi Session
session_start();
 
// Cek login
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if ($_SESSION["level"] === "A"){
        header("location: admin.php");
    }
    else if ($_SESSION["level"] === "B"){
        header("location: manager.php");
    }
    exit;
}
 
// Connect database
require_once "db_login.php";
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_database);
 		
// Cek koneksi
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Deklarasi
$username = "";
$password = "";
$wrong = "";
 
// Validasi
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validasi username
    if(empty(trim($_POST["username"]))){
        $wrong = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Validasi Password
    if(empty(trim($_POST["password"]))){
        $wrong = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Cek ke database
    if(empty($username_err) && empty($password_err)){
        // Query data
        $sql = "SELECT idpegawai, username, password, level FROM pegawai WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password, $level);
                    if($stmt->fetch()){
                        if($password === $hashed_password){
                            // Simpan session jika password benar
                            session_start();
                            
                            // Simpan session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["level"] = $level;                            
                            
                            // Redirect user
                            if ($_SESSION["level"] === "A"){
                                header("location: admin.php");
                            }
                            else if ($_SESSION["level"] === "B"){
                                header("location: manager.php");
                            }
                        } else{
                            // Jika password salah
                            $wrong = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Jika username salah
                    $wrong = "No account found with that username.";
                }
            } else{
                // Jika password salah
                echo "Oops! Something went wrong. Please try again later.";
            }
        
            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    $mysqli->close();
}
?>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div id="uiform">
        <a href="home.php"><img src="media/corp.png" width="70px"></a>
        <h1>Welcome!</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h5 id="wrong" style="text-align: center; color: red"><?php echo $wrong?></h5>
            <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <p>©2019 Copyright. WebProject2.</p>
    </div>
</body>