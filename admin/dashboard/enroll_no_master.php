<?php
	if(isset($_COOKIE['login'])){
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
                        <h4 align="center">Add Enrollment No</h4><hr><br>
                    </div>                                        
                    <div class="col-lg-2"></div>                    
                    <div class="col-lg-8">
                    
                    <?php $query=$db->query("SELECT * FROM enroll_master") or die("");
						  if($query->rowCount()==0){
							  ?>
                               <form name=" " method="post" enctype="multipart/form-data" action="enroll_no_master_do.php">
                    	<label>Enter Enrollment No : </label>
                        
                        <input type="hidden" name="txtHide" id="txtHide">
                        
                        <input autofocus type="text" id="txtEnroll" name="txtEnroll" class="form-control" placeholder="Enter Enrollment No *" required><br>
                        <button type="submit" class="btn btn-sm btn-info btnEnrollNo">Submit</button>
                   </form>  
                              <?php
						  }
						  else{
							  
							  $result=$query->fetch(PDO::FETCH_ASSOC);
							  
							  
							  ?>
                               <form name=" " method="post" enctype="multipart/form-data" action="enroll_no_master_do.php">
                    	<label>Enter Enrollment No : </label>
                        
                        <input type="hidden" value="<?php echo $result['id']; ?>" name="txtHide" id="txtHide">
                        
                        <input value="<?php echo $result['enroll_no']; ?>" autofocus type="text" id="txtEnroll" name="txtEnroll" class="form-control" placeholder="Enter Enrollment No *" required><br>
                        <button type="submit" class="btn btn-sm btn-info btnEnrollNo">Submit</button>
                   </form>  
                              <?php
						  }
					 ?>
                    
                      
                    </div>                    
                    <div class="col-lg-2">                    
                    </div>                    
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