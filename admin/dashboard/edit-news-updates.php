
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
                        <h4 align="center" class="page-header">
                           Edit News & Updates
                        </h4>
<ol class="breadcrumb">

 <li class="active">
                                <a href="add-news-updates.php"><i class="fa fa-dashboard"></i> Add News & Updates</a>
                            </li>
                        
                            
                            <li class="active">
                               <a href="manage-news-updates.php"> <i class="fa fa-dashboard"></i> Manage News & Updates
                                </a>
                            </li>
    
                            

    
    
    
    

                        </ol>
                    </div>
                    <div class="col-lg-1"></div>
                    
                    <div class="col-lg-10">
                        
                        <form role="form" name="" method="post" enctype="multipart/form-data" action="edit-news-updates-do.php">
                        
                        
                       <?php
					   $query=$db->query("select * from news_and_updates where news_id=$editID") or die("error");
					   while($result=$query->fetch(PDO::FETCH_ASSOC))
					   {
						   
					   ?>
                            
                            

<div class="form-group">

<select class="form-control" id="txtSelTrainingInstitute" name="txtSelTrainingInstitute" autofocus>
                        	
                            <?php $i_q=$db->query("SELECT o_c_n_id, id,t_c_name,t_state,t_city FROM center_info_master WHERE flag='true'    ORDER BY id desc") or die("");
							$i=0;
								while($i_q_res=$i_q->fetch(PDO::FETCH_ASSOC)){
								
									
									if($result['institute_id']==$i_q_res['id']){
										?>
                                        <option selected  value="<?php echo $i_q_res['id'] ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                                        <?php
									}
									else{									
							 ?>
                             <?php if($i==0){ $i++;
						  ?> <option selected value="0">select all training institute</option>
							<?php }
							 else{
								 ?>
                            <option  value="<?php echo $i_q_res['id']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                            <?php } ?>
                            <?php } } ?>
                        </select>
                     </div>   
                        
                        
                        
                            <div class="form-group">
                                <label>Enter Title</label>
                                <input required name="title"  type="text" class="form-control" value="<?php echo $result['news_title']; ?>">
                                
                                <input type="hidden" name="txtHide" value="<?php echo $result['news_id']; ?>">
                               
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label>Select Date</label>
                                <input required name="date" value="<?php echo $result['news_date']; ?>"  type="date" class="form-control">
                               
                            </div>
                            
                            
                            
                            
                            
                            
                                <div class="form-group">
                                <label>Event Descp</label>
                                <textarea  name="descp"   class="form-control" ><?php echo $result['news_Descp']; ?></textarea>
                                
                               
                            </div>
                            
                            
                            
                            
                             <div class="form-group">
                                <label>Image</label>
                                <input  name="newsImg"  type="file" class="form-control">
                               
                            </div>
                            
                            
                            
                            
                            
                            
                        
                        

                           
                            
                            
                             
                            
                            
                            
                            
 <button type="submit" class="btn btn-primary btn-sm">Submit </button>
 <?php if($result['news_img_ext']!=NULL)
 { ?>
           <span style="float:right;">
           		<img src="../../newsImage/<?php echo $result['news_id'].".".$result['news_img_ext']; ?>" style="width:100px; height:50px;">
           </span>
           <?php } else
		   {
		   }?>
<?php }?>
                        </form>
                        
                    </div>
                    <div class="col-lg-1"></div>
                    
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

