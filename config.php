<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$host = 'pujiyulitomowebappserver.database.windows.net';
$username = 'apayah90';
$password = 'terserah90!';
$db_name = 'pujiyulitomowebapp';
 

 
 //Establishes the connection

 //Establishes the connection
 try {
        $link = new PDO("sqlsrv:server = $host; Database = $db_name", $username, $password);
        $link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

// Check connection


//


?>
