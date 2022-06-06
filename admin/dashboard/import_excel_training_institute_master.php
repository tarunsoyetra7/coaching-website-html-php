<?php
	if(isset($_COOKIE['login'])){
		$login=$_COOKIE['login'];
	require("../../root/db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 align="center">
                            	<strong>Training Institute Master</strong>
                        </h4>
                       <hr>
                       
                         <ol class="breadcrumb">
                            <li class="active">
                               <a href="training_institute_master.php">
                               		<i class="fa fa-dashboard"></i> Add Institute
                               </a>
                            </li>
                            
                            
                         <!---   <li class="active">
                               <a href="import_excel_training_institute_master.php">
                               		<i class="fa fa-dashboard"></i> Import Excel
                               </a>
                            </li>
                            
                          --->  
                            
                            <li class="active">
                               <a href="manage_training_institute_master.php">
                               		<i class="fa fa-dashboard"></i> Manage Institute
                               </a>
                            </li>
                            
                            
                        </ol>
                       
                    </div>                    
                    
                    <form name="" method="post" enctype="multipart/form-data" action="excel_institute_master_do.php">
                    <div class="col-lg-6">
                    	<label>Attachment : </label>
                        <input type="file" class="form-control" name="txtCsvFile" required>
                        <span class="pull-right"><strong>(file format .csv, .CSV)</strong></span>
                        
                        
                        <br>
                        
                    </div>
                    <div class="col-lg-1">
                    	<br>
                        
                        <button class="btn btn-sm btn-info" type="submit" style="margin-top:5px;">Submit</button>
                    </div>
                  </form>  
                    <div class="col-lg-12"><hr></div>
                    
           
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>