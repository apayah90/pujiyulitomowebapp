<?php
    session_start();
    include_once('config.php');

    if(isset($_GET['id'])){
        $database = new Config();
        $db = $database->openConnection();
        try{
            $sql = "DELETE FROM customers WHERE id = '".$_GET['id']."'";
            //if-else statement in executing our query
            $_SESSION['message'] = ( $db->exec($sql) ) ? 'Member deleted successfully' : 'Something went wrong. Cannot delete member';
        }
        catch(PDOException $e){
            $_SESSION['message'] = $e->getMessage();
        }

        //close connection
        $database->close();

    }
    else{
        $_SESSION['message'] = 'Select member to delete first';
    }

    header('location: index.php');

