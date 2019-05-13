

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
                        <h2 class="pull-left">Daftar Pelanggan Pulsa</h2>
                        <a href="create.php" class="btn btn-success pull-right">Tambah Pembeli Baru</a>
                        
                    </div>
                                <?php 
                session_start();
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-info text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>


                    
                      
                        <table class='table table-bordered table-striped'>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Notelp</th>
                                <th>Action</th>
                            </tr>    
                        

                    <?php
                    //include config
                    require_once("config.php");
                    $config = new Config();
                    $cfg= $config->openConnection();
                    

                    try{

                        $sql = 'SELECT * FROM customers';
                        foreach ($cfg->query($sql) as $row) {
                            ?>
                            <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['notelp']; ?></td>
                            <td><a href='#edit_<?php echo $row['id']; ?>' title='Update Record' data-toggle='modal'><span class='glyphicon glyphicon-pencil'></span></a>
                            <a href='#delete_<?php echo $row['id']; ?>' title='Delete Record' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span></a>
                            </td>
                            <?php include('edit_delete_modal.php'); ?>
                            </tr>
                            <?php
                           }

                        }
                        catch(PDOException $e) {
                            echo "Failed". $e->getMEssage();
                        }

                        //close connection
                        $config->close();

                        ?>



                    </table>
                
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
