<?php
	if(isset($_COOKIE['login'])){
		
		$login_id= $_COOKIE['login'];
		require("../../root/db_connection.php");
		/*----query for login type---*/
		$loginTypeQ=$db->query("select login_type from user_infromation where user_id=$login_id") or die("");
		
		$loginTypeQ_res=$loginTypeQ->fetch(PDO::FETCH_ASSOC);
		$login_type=$loginTypeQ_res['login_type'];
		
		if($login_type=="sadmin"){
			$fetch_condition="";
			
		}
		else{
			$fetch_condition="AND created_by=$login_id";
		}
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
                            Add News & Updates
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
                        
                        <form id="txtNewsFrm" name="" method="post" enctype="multipart/form-data" action="add-news-updates-do.php">
                        
                        
                        <div class="form-group">
                       <label>Select Training Institute :</label>
						<select class="form-control" id="txtSelTrainingInstitute" name="txtSelTrainingInstitute" autofocus>
                        <option value="s_in">---select training institute---</option>
                        	<option value="0">select all training institute</option>
                            <?php $i_q=$db->query("SELECT o_c_n_id, id,t_c_name,t_state,t_city FROM center_info_master WHERE flag='true'    ORDER BY id desc") or die("");
								while($i_q_res=$i_q->fetch(PDO::FETCH_ASSOC)){
							 ?>
                            <option  value="<?php echo $i_q_res['id']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                            <?php } ?>
                        </select>
                       </div>
                            

                            <div class="form-group">
                                <label>Enter Title</label>
                                <input  name="title" id="txtTitle"  type="text" class="form-control" placeholder="Enter  Title">                               
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Select Date</label>
                                <input  name="date" value="<?php echo date("Y-m-d");?>"  type="date" class="form-control">
                               
                            </div>
                            
                                <div class="form-group">
                                <label>Event Descp</label>
                                <textarea  name="descp"   class="form-control" placeholder="Enter Descp"></textarea>                               
                               
                            </div>
                            
                            
                            
                             <div class="form-group">
                                <label>Image</label>
                                <input  name="newsImg"  type="file" class="form-control">
                               <span class="pull-right">(jpg, png, jpeg, pdf, xls, csv, docx)</span>
                            </div>
                            
                            
 <button type="button" class="btn btn-primary btn-sm btnNewsSubmit">Submit </button>
                            

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

   <script>
   $(".btnNewsSubmit").on("click",function(e){
	   if($("#txtSelTrainingInstitute option:selected").val()=="s_in"){
		   $("#txtSelTrainingInstitute").focus();
		   alert("please select training institute !....");
	   }
	   else if($("#txtTitle").val()=="" || $("#txtTitle").val()==null){
		   $("#txtTitle").focus();
	   }
	   else{
		   $("#txtNewsFrm").submit();
	   }
   });
   </script>

</body>

</html>
<?php
}

else
{

	header("location:../index.php");	
}

?>

