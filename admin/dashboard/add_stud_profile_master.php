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
                        <h4 align="center">Add Student Image</h4><hr>
                        
                        
                        <ol class="breadcrumb">
                            <li class="active">
                               <a href="student_info_master.php">
                               		<i class="fa fa-dashboard"></i> Add Student
                               </a>
                            </li>
                            
                             <li class="active">
                               <a href="import_student_excel_master.php">
                               		<i class="fa fa-dashboard"></i> Import Excel 
                               </a>
                            </li>
                            
                           
                             <li class="active">
                               <a href="add_stud_profile_master.php">
                               		<i class="fa fa-dashboard"></i> Add Student Profile
                               </a>
                            </li>
                            
                            <li class="active">
                               <a href="manage_stud_info_master.php">
                               		<i class="fa fa-dashboard"></i> Manage Student
                               </a>
                            </li>
                            
                            
                        </ol>
                        
                        
                    </div>                    
                    <div class="col-lg-1"></div>
                    
                    <div class="col-lg-10"><br>
                    <form name="" method="post" enctype="multipart/form-data" action="add_stud_profile_master_do.php">
                    
                    <label>Select Training Institute :</label>
						<select class="form-control" id="txtSelTrainingInstitute" name="txtSelTrainingInstitute" autofocus>
                        	
                            <?php $i_q=$db->query("SELECT o_c_n_id, id,t_c_name,t_state,t_city FROM center_info_master WHERE flag='true'   $fetch_condition     ORDER BY id desc") or die("");
								while($i_q_res=$i_q->fetch(PDO::FETCH_ASSOC)){
							 ?>
                            <option  value="<?php echo $i_q_res['id']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                            <?php } ?>
                        </select>
                        
                        
                        <br>
                    <label>Student ID</label>
                    <input autofocus name="txtIdRange" id="txtIdRange" required type="text" class="form-control" placeholder="Enter Student ID (100-200) *"><br>
                    
                    	<label>Select Image : </label>
                        <input type="file" multiple name="txtStudImage[]" class="form-control" required>
                        <br>                        
                        <button class="btn btn-sm btn-info">Submit</button>
                        </form>
                    </div>
                    
                    <div class="col-lg-1"></div>
                    
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