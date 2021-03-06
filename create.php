<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$nama = $email = $alamat = $notelp = "";
$nama_err = $email_err = $alamat_err = $telp_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nama
    $input_name = trim($_POST["nama"]);
    if(empty($input_name)){
        $name_err = "Masukan Nama ";
    } elseif(!filter_var(trim($_POST["nama"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nama_err = 'Silahkan masukan nama yang valid';
    } else{
        $nama = $input_name;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Silahkan masukan email.';     
    } else{
        $email = $input_email;
    }
    
    // Validate poin
    $input_alamat = trim($_POST["alamat"]);
    if(empty($input_alamat)){
        $alamat_err = "Silahkan Masukan Alamat";     
    } 
    else{
        $alamat = $input_alamat;
    }
	
	// Validate badge
	$input_telp = trim($_POST["telp"]);
	if(empty($input_telp)) {
		$telp_err = "Silahkan Masukan No.Telp";
    }
    elseif(!ctype_digit($input_telp)){
        $telp_err = 'Silahkan Masukan No Telp yang Benar';}
		else {
            $notelp = $input_telp;
            
		}
	
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($email_err) && empty($alamat_err) && empty($telp_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO customers (nama, email, alamat, notelp) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_nama, $param_email, $param_alamat, $param_telp);
            
            // Set parameters
            $param_nama = $nama;
            $param_email = $email;
            $param_alamat = $alamat;
			$param_telp = $notelp;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($alamat_err)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>">
                            <span class="help-block"><?php echo $alamat_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($telp_err)) ? 'has-error' : ''; ?>">
                            <label>No.Telp</label>
                            <textarea name="telp" class="form-control"><?php echo $notelp; ?></textarea>
                            <span class="help-block"><?php echo $telp_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>