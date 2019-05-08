<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$host = 'pujiyulitomowebappserver.database.windows.net';
$username = 'apayah90';
$password = 'terserah90!';
$db_name = 'pujiyulitomowebapp';
 

 
 //Establishes the connection
$link = mysqli_init();
mysqli_real_connect($link, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($link)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//


?>
