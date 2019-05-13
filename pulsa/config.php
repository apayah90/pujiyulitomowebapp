<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

 

 
 //Establishes the connection
 /**
  * 
  */
 Class Config
 {

private $server = 'mysql:host=localhost;dbname=pujiyulitomoapp';
private $user = 'root';
private $pass = '';
private $db_name = 'pujiyulitomoapp';
private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
protected $link;
 

 
 //Establishes the connection

 //Establishes the connection
 
    

// Check connection
     public function openConnection() {
     try {
      $this->link = new PDO($this->server, $this->user,$this->pass,$this->options);
      return $this->link;
       echo "Berhasil terkoneksi ke database";
    } catch(Exception $e) {
        echo "Failed: " . $e->getMessage();
    }

    }

    public function close() {
     
    $this->link = null;

    }

}
// Check connection

//show Customer
/*    public function showCustomer() {
    	$sql = "SELECT * FROM customers";
    	$query = $this->link->query($sql);
    	return $query;
    }
//add Customer
public function addCustomer($nama, $email, $alamat, $notelp) {
	$sql = "INSERT INTO customers (nama, email, alamat, notelp) VALUES ($nama', '$email', '$alamat', '$notelp')";
	$query = $this->link->query($sql);
	if (!$query) {
		return "Failed";
		# code...
	}
	else {
		return "Success";
	}
}

}*/

?>
