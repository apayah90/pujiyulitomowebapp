<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'pujiyulitomowebappserver.database.windows.net');
define('DB_USERNAME', 'apayah90');
define('DB_PASSWORD', 'terserah90!');
define('DB_NAME', 'pujiyulitomowebapp');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
