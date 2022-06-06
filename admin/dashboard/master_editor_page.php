<?php
	if(isset($_COOKIE['login'])){
	
		$login_id= $_COOKIE['login'];
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
                        <h4 align="center"><strong>Menu  Master</strong></h4>                         
					   <hr>
                       
                       <ol class="breadcrumb">
					   

					   
                           <li class="active">
                                <a href="add_employee.php"><i class="fa fa-dashboard"></i> Add Employee</a>
                            </li>
							
							<li class="active">
                                <a href="authentication_page.php"><i class="fa fa-dashboard"></i> Add Authentication</a>
                            </li>
                            
							<li class="active">
                                <a href="employee_login_status.php"><i class="fa fa-dashboard"></i> Employee Login Status</a>
                            </li>
							
                        </ol>
                    </div>
                  
                  
				  <!--start --->
<!---editor--->   <script src="ckeditor.js"></script>
            <script src="samples/js/sample.js"></script>
            
            <link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
            <script src="js/jquery.min.js"></script>
			<script>
			$('#editor1').ckeditor({ height: 100 });

			</script>
            <style>
		#cke_1_contents{
			height:300px !important;
		}
	</style>
	     
            <div class="col-lg-6">
            
			
            <main>
            	<div id="editor"></div>
            </main>
			
			</div>
         
            
				  <!---end--->
				   <script>
            	initSample();
            </script>
				
  


                    
                                        
                   </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>