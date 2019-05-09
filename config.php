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
       echo "Berhasil terkoneksi ke database";
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

// Check connection

//show Customer
    public function showCustomer() {
    	$sql = "SELECT * FROM customers";
    	$query = $this->$link->query($sql);
    	return $query;
    }
//add Customer
public function addCustomer($id, $nama, $email, $alamat, $notelp) {
	$sql = "INSERT INTO customers (id, nama, email, alamat, notelp) VALUES ('$id', '$nama', '$email', '$alamat', '$notelp')";
	$query = $this->$link->query($sql);
	if (!$query) {
		return "Failed";
		# code...
	}
	else {
		return "Success";
	}
}

?>

