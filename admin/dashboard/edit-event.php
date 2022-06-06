
<?php
if(isset($_COOKIE['login']))
{
	?>
<?php

require("../../root/db_connection.php");
$editID=$_REQUEST['editID'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">



    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



        
        
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        include("header.php");
        
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 align="center" class="page-header">
                            Edit Event
                        </h1>
<ol class="breadcrumb">

 <li class="active">
                                <a href="add-event.php"><i class="fa fa-dashboard"></i> Add Event</a>
                            </li>
                            
                            <li class="active">
                                <a href="add-image.php"><i class="fa fa-dashboard"></i> Add Image</a>
                            </li>
                            
                            
                            <li class="active">
                               <a href="manage-event.php"> <i class="fa fa-dashboard"></i> Manage Event
                                </a>
                            </li>
    

    
    
    
    

                        </ol>
                    </div>
                    
                    <div class="col-lg-6">
                        
                        <form role="form" name="" method="post" enctype="multipart/form-data" action="edit-event-do.php">
                        
                        
                         
                            
<?php
$query=$db->query("select * from event where event_id=$editID") or die("Error");
while($result=$query->fetch(PDO::FETCH_ASSOC))
{

?>
                           
                            
                          <label>Event Title</label>
                          <input type="text" name="event_title" value="<?php echo $result['event_title']; ?>" class="form-control">
                          
                          <input type="hidden" name="txtHide" value="<?php echo $result['event_id']; ?>"
							>
                        
             <?php }?>           
                       
      <br>                      
 <button type="submit" class="btn btn-primary btn-sm">Update </button>
                            

                        </form>
                        
                    </div>
                    
                </div>
             
               <br><br>      <br><br>     
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
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

