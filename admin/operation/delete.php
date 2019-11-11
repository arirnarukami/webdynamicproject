<?php
    // connect database 
    require_once('../db_login.php');
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
            
    if ($db->connect_errno){     
        die ("Could not connect to the database: <br />". $db->connect_error); 
    }

    $id = $_GET['id'];
    $ops = $_GET['ops'];

    if ($ops == 1){
        //Assign  a  query
        $query  =  "DELETE FROM produk WHERE idkategori = ".$id." ";
        //Execute  the  query
        $result  =  $db->query($query); 
        if  (!$result){
            die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
        } else{
            $query  =  "DELETE FROM subkategori WHERE idkategori = ".$id." ";
            $result2  =  $db->query($query); 
            if  (!$result2){
                die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
            }else{
                $query  =  "DELETE FROM kategori WHERE idkategori = ".$id." ";
                $result3  =  $db->query($query); 
                if  (!$result3){
                    die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
                }else{
                    header('Location: ../admin_kategori.php');
                }
            }    
        }
    }
    else if($ops == 2){
        //Assign  a  query
        $query  =  "DELETE FROM produk WHERE idsubkategori = ".$id." ";
        //Execute  the  query
        $result  =  $db->query($query); 
        if  (!$result){
            die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
        } else{
            $query  =  "DELETE FROM subkategori WHERE idsubkategori = ".$id." ";
            $result2  =  $db->query($query); 
            if  (!$result2){
                die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
            } else{
            header('Location: ../admin_subkategori.php');    
            }
        }
    }
    else if($ops == 3){
        //Assign  a  query
        $query  =  "DELETE FROM produk WHERE idproduk = ".$id." ";
        //Execute  the  query
        $result  =  $db->query($query); 
        if  (!$result){
            die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
        } else{
            header('Location: ../admin_produk.php');    
        }
    }
    else if($ops == 4){
        //Assign  a  query
        $query  =  "DELETE FROM pegawai WHERE idpegawai = ".$id." ";
        //Execute  the  query
        $result  =  $db->query($query); 
        if  (!$result){
            die  ("Could  not  query  the  database:  <br  />".  mysqli_error($db));
        } else{
            header('Location: ../admin_pegawai.php');    
        }
    }
?>