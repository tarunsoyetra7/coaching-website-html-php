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
                        <h4 align="center">
                            	Import Execl
                        </h4>
                       <hr>
                       
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
                            
                           <!--  <li class="active">
                               <a href="add_stud_profile_master.php">
                               		<i class="fa fa-dashboard"></i> Add Student Profile
                               </a>
                            </li>-->
                            
                            <li class="active">
                               <a href="manage_stud_info_master.php">
                               		<i class="fa fa-dashboard"></i> Manage Student
                               </a>
                            </li>
                            
                        </ol>
                       
                    </div>                    
                    <div class="col-lg-1"></div>
                    <form name="" method="post" enctype="multipart/form-data" action="import_student_excel_master_do.php">
                    <div class="col-lg-10">
                    
                     


<label>Select Training Institute :</label>
						<select class="form-control" id="txtSelTrainingInstitute" name="txtSelTrainingInstitute" autofocus>
                        	<option value="i_n">---Select Training Institute</option>
                            <?php $i_q=$db->query("SELECT id,o_c_n_id, id,t_c_name,t_state,t_city FROM center_info_master WHERE flag='true'    ORDER BY id desc") or die("");
								while($i_q_res=$i_q->fetch(PDO::FETCH_ASSOC)){
							 ?>
                            <option  value="<?php echo $i_q_res['id']."|".$i_q_res['o_c_n_id']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                            <?php } ?>
                        </select>
                        <br>
					
						<label>Select Name of the Course Applied For :</label>
						<select class="form-control" id="txtSelCourse" name="txtSelCourse"  autofocus>
                        	<option value="s_c">---select course---</option>
                            
                        </select>
                        <br>
                    
				   <div style="clear:both;"></div>
                    
                        
                    	<label>Attachment : </label>
                        <input type="file" class="form-control" name="txtCsvFile" required>
                        <span class="pull-right"><a href="../../sample_doc/student_info.csv" target="_blank">download sample</a>      <strong>(file format .csv, .CSV)</strong></span>
                        
                        
                        <br>
                        
                        
                          <button class="btn btn-sm btn-info" type="submit" style="margin-top:5px;">Submit</button>
                  
                  
                  
                  
                    </div>
                    
                      
                  </form>
                  <div class="col-lg-1"></div>  
                    <div class="col-lg-12"><hr></div>
                    
           
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
    
    <script>
	$("#txtSelTrainingInstitute").on("change",function(e){
				
		$("#course_res").html("");
		
		if($("#txtSelTrainingInstitute option:selected").val()=="i_n"){
			alert("please select institute !...");
		}
		else{
			var i_name=$("#txtSelTrainingInstitute option:selected").val();
			
			
			var a=i_name.split("|");
			
			i_name=a[1];
			
			//alert(i_name);
			$.ajax({
				type:"POST",
				
				data:{id:i_name},
				url:"fetch_course_institute_name.php",
				dataType:"json",
				cache:false,
				
				success:function(r_data){
					if(r_data.length==0){
						alert("No Course in Institute... ");
					}
					else{
						var empty_c_name="";
						
						var f_op="<option value='s_c'>---select course---</option>";
						for(i=0; i<r_data.length; i++){
							
							
							
							empty_c_name=empty_c_name+"<option value='"+r_data[i].id+"'>"+r_data[i].c_name+"-"+r_data[i].c_duration+"</option>";
						}
						$("#txtSelCourse").html(f_op+empty_c_name);
					}
				},error:function(err){
					location.reload();
				}
			});
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