<!--File  : upload.php
     Deskripsi : memproses upload file -->
     <html>
<head>
	<title>Uploading...</title>
</head>

<body>
	<h1>Uploading file...</h1>
	<?php 
		$idproduk = $_GET['idproduk'];
		if ($_FILES['userfile']['error'] > 0) {
		echo 'Problem: ';
		switch ($_FILES['userfile']['error'])  {
			case 1:
				echo 'File exceeded upload_max_filesize';
				break;
			case 2:
				echo 'File exceeded max_file_size';
				break;
			case 3:
				echo 'File only partially uploaded';     
				break;
			case 4:
				echo 'No file uploaded';     
				break;
			case 6:
				echo 'Cannot upload file: No temp directory specified';
				break;
			case 7:  
				echo 'Upload failed: Cannot write to disk';     
				break;  
			}
		exit;
	} 
 
    $target_dir = "../../media/"; 
    $target_file = $target_dir .  basename($_FILES['userfile']['name']);
	$upload_ok = 1; $file_type = pathinfo($target_file,PATHINFO_EXTENSION); 
	$target_file = $target_dir.$_GET['idproduk'].'.'.$file_type;
	// Allow certain file formats 
	$allowed_type = array("jpg", "png", "PNG", "jpeg", "gif"); 
	if(!in_array($file_type, $allowed_type)) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		
		$upload_ok = 0; 
	}

	// put the file where we'd like it 
	if ($upload_ok != 0){
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])){
			if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)){
				echo 'Problem: Could not move file to destination directory';
			}
			else{    
				echo 'File uploaded successfully<br /><br />';
				echo 'File Name: '.basename($_FILES['userfile']['name']);
				// connect database
				require_once('../db_login.php');
				$db = new mysqli($db_host, $db_username, $db_password, $db_database);
				if ($db->connect_errno){  
					die ("Could not connect to the database: <br />". $db>connect_error); 
				}
				$name = $db->real_escape_string($target_file);
				$result = $db->query('UPDATE produk SET gambar_produk="'.$_GET['idproduk'].'.'.$file_type.'" WHERE idproduk='.$_GET['idproduk']);
				if (!$result){      
					die ("Could not query the database: <br />". $db->error);   
				}else{
					$db->close();    
					header("location: ../admin_produk.php");
					exit;   
				}
			}  
		}
		else{   
			echo 'Problem: Possible file upload attack. Filename: ';
			echo $_FILES['userfile']['name'];
		}
}
?>
</body>
</html>