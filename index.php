

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Detail Pembeli</h2>
                        <a href="create.php" class="btn btn-success pull-right">Tambah Pembeli Baru</a>
                        
                    </div>
                    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>


                    <div class="container">
                        <h2>Daftar Customer</h2>
                        <table class="table">
                            <tr>
                                <td>Id</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Alamat</td>
                                <td>Notelp</td>
                                <td>Action</td>
                            </tr>    
                        

                    <?php
                    require_once("config.php");
                    $Cfg = new Config();
                    $show = $Cfg->showCustomer();
                    while ($row = $show->fetch(PDO::FETCH_OBJ)) {
                        echo "
                        <tr>
                        <td>$row->$id</td>
                        <td>$row->$nama</td>
                        <td>$row->$email</td>
                        <td>$row->$alamat</td>
                        <td>$row->$notelp</td>
                        <td><a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                            <a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                        </td>
                        </tr>";
                    };



                    ?>

                    </table>
                    </div>

                </div>
            </div>        
        </div>
    </div>
</body>
</html>

