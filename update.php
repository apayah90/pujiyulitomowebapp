<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$nama = $email = $alamat = $notelp = "";
$nama_err = $email_err = $alamat_err = $notelp_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Silahkan Masukan Nama";
    } elseif(!filter_var(trim($_POST["nama"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nama_err = 'Silahkan Masukan Nama Valid';
    } else{
        $nama = $input_nama;
    }

    // vALIDATE TOKEN
    
    
    // Validate address address
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Silahkan masukan email';     
    } else{
        $email = $input_email;
    }
    
    // Validate salary
    $input_alamat = trim($_POST["alamat"]);
    if(empty($input_alamat)){
        $alamat_err = "Silahkan Masukan Alamat";     
    }  else{
        $alamat = $input_alamat;
    }
	
	// Validate badge
    $input_notelp = trim($_POST["notelp"]);
    if(empty($input_notelp)){
        $notelp_err = "Silahkan Masukan No.Telp";     
    }  elseif(!ctype_digit($input_notelp)){
        $notelp_err = 'Silahkan masukan No.Telp yang benar ';
    }
    else{
        $notelp = $input_notelp;
    }
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($email_err) && empty($alamat_err) && empty($notelp_err)){
        // Prepare an update statement
        $sql = "UPDATE customers SET nama=?, email=?, alamat=?, notelp=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_nama, $param_email, $param_alamat, $param_notelp, $param_id);
            
            // Set parameters
            $param_nama = $nama;
            $param_email = $email;
            $param_alamat = $alamat;
            $param_notelp = $notelp;
            
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM customers WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nama = $row["nama"];
                    $email = $row["email"];
                    $alamat = $row["alamat"];
					$notelp = $row["notelp"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
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
                        
						<div class="form-group <?php echo (!empty($notelp_err)) ? 'has-error' : ''; ?>">
                            <label>No.telp</label>
                            <input type="text" name="notelp" class="form-control" value="<?php echo $notelp; ?>">
                            <span class="help-block"><?php echo $notelp_err;?></span>
                        </div>
						
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>