<?php

 
    session_start();
    include_once('config.php');

    if(isset($_POST['edit'])){
        $database = new Config();
        $db = $database->openConnection();
        try{
            $id = $_GET['id'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $notelp = $_POST['notelp'];

            $sql = "UPDATE customers SET nama = '$nama', email = '$email', alamat = '$alamat', notelp = '$notelp' WHERE id = '$id'";
            //if-else statement in executing our query
            $_SESSION['message'] = ( $db->exec($sql) ) ? 'Member updated successfully' : 'Something went wrong. Cannot update member';

        }
        catch(PDOException $e){
            $_SESSION['message'] = $e->getMessage();
        }

        //close connection
        $database->close();
    }
    else{
        $_SESSION['message'] = 'Fill up edit form first';
    }

    header('location: index.php');


?>
 
