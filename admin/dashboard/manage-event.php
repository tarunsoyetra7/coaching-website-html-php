<?php
if(isset($_COOKIE['login']))
{
?>



<?php
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
                            Manage Events
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
                    
                    <div class="col-lg-12">
                        
                        <table class="table table-responsive table-bordered">
                        <tr>
                        	<th>No.</th>
                           
                            <th>Event Name</th>
                           
                             <th>Image</th>
                             
                           
                            <th>Option</th>
                       
                       <?php
					   $query=$db->query("select * from event order by event_id desc") or die("error");
					   
					   //$event_query=mysql_query("select * from event order by event_id desc") or die("error");
					   $i=0;
					   while($result=$query->fetch(PDO::FETCH_ASSOC))
					   {
						   $i++;
						   $event_ID=$result['event_id'];
						   /*
					   while($event_result=mysql_fetch_array($event_query))
					   {
						*/   
					   
					   ?>
                        
                        </tr>
                        
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['event_title']; ?></td>
                         
                        
                        <td >
                        <?php
						$image_query=$db->query("SELECT * FROM event_image WHERE select_event_id=$event_ID ORDER BY img_id desc") or die("error");
					
					while($image_result=$image_query->fetch(PDO::FETCH_ASSOC))
					{	
						?>
                        <div style="float:left; margin-bottom:5px; margin-top:5px; margin-left:2px;">
						<img  src="../../event-image/<?php echo $image_result['img_id'].".".$image_result['img_ext']; ?>" style="width:65px; height:65px;" class="img-responsive">
                        <p align="center">
<a href="delete-event-image.php?deleteImageId=<?php echo $image_result['img_id']; ?>&delete_image_ext=<?php echo $image_result['img_ext']; ?>">Delete</a>
                        </p>
                        
                        </div>
                        <?php
					}?>
						</td>
                       
                        <td><a href="edit-event.php?editID=<?php echo $result['event_id']; ?>">Edit</a> | <a href="delete-event.php?deleteID=<?php echo $result['event_id'] ?>">Delete</a></td>
                        </tr>
         <?php
					   }?>
                        </table> 
                        
                    </div>
                    
                </div>
             
               <br><br>   
                    
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