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
                        <h4 align="center"><strong>Student  Master</strong></h4>                        
                       
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

<?php if(isset($_REQUEST['id'])){
	$edit_id=$_REQUEST['id'];
	
	$fetchQ=$db->query("SELECT id,stud_document,
	institut_id,stud_enroll_no ,institute_name ,
	course_id ,course_name ,
	stud_name ,stud_image ,
	stud_m_name ,stud_f_name ,
	stud_occupation ,stud_orgnization ,stud_add,
	stud_dob ,stud_marital ,stud_gender ,
	stud_city ,stud_pin ,stud_state ,
	stud_email ,stud_aadhr ,stud_mo ,
	stud_ten_quali ,stud_ten_school ,
	stud_ten_board ,stud_ten_yop ,
	stud_ten_mark ,stud_ten_doc ,
	stud_ele_quali ,stud_ele_school ,
	stud_ele_board ,stud_ele_yop ,
	stud_ele_mark ,stud_ele_doc ,
	stud_clg_quali ,stud_clg_school ,
	stud_clg_board ,stud_clg_yop ,stud_clg_mark ,
	stud_clg_doc 
	 FROM tmp_student_master  WHERE flag='true' and id = $edit_id") or die("");
	 
	 $fetchQ_res=$fetchQ->fetch(PDO::FETCH_ASSOC);
	 ?>
     
     
     <?php
      
	   $enrollQ=$db->query("SELECT * FROM enroll_master limit 1") or die("");
	   $enrollQ_res=$enrollQ->fetch(PDO::FETCH_ASSOC);
	   
   		
		$max_id_q=$db->query("SELECT (IFNULL(MAX(id),0))+1 AS ID FROM student_master") or die("");	
		$max_id_q_res=$max_id_q->fetch(PDO::FETCH_ASSOC);	
		$enroll_id=$max_id_q_res['ID'];
		
		$studEnrollNo=$enrollQ_res['enroll_no'].$enroll_id;
	?> 
   
                       <p align="center"> <strong>Enroll ID : </strong> <?php echo $studEnrollNo; ?></p>
                         
                         
                         
                         
  <form name="" method="post" id="studentInfoFrm" enctype="multipart/form-data" action="student_info_master_do_11.php">			
					<div class="col-lg-12">
                    
                  
						<label> Training Institute :</label>
                        
                     
                     <input type="hidden" name="txtSelTrainingInstitute" value="<?php echo $fetchQ_res['course_id']."|".$fetchQ_res['institut_id']."|".$fetchQ_res['institute_name']; ?>">
                     
                     <input readonly type="text" class="form-control"  value="<?php echo $fetchQ_res['institute_name']; ?>">
                        
						
                        <br>
					</div>
					
					
					<div class="col-lg-12">
						<label>Name of the Course Applied For :</label>
                        
                        <input type="hidden" id="txtSelCourse"  name="txtSelCourse" value="<?php echo $fetchQ_res['course_id']."|".$fetchQ_res['course_name']; ?>">
                        
                        <input readonly type="text" class="form-control" value="<?php echo $fetchQ_res['course_name']; ?>">
                       
                        <br>
                        
                   
				   
					</div>
					
					<div class="col-lg-6">
						<label>Name of Applicant :</label>
						<input type="text" id="txtNOfAppli" name="txtNOfAppli" class="form-control" value="<?php echo $fetchQ_res['stud_name']; ?>" placeholder="Name of Applicant *"><br>
					</div>
					
					<div class="col-lg-5">
						<label>Photograph:</label>
						<input id="txtPhoto"  name="txtPhoto" type="file" class="form-control" ><br>
					</div>
                    
                    <div class="col-lg-1" style="padding-left:0px;"><br><img src="../../stud_documents/<?php echo $fetchQ_res['stud_image']; ?>" style="width:50px; height:50px;"></div>
					
					
					<div class="col-lg-6">
						<label>Mother Name :</label>
						<input value="<?php echo $fetchQ_res['stud_m_name']; ?>" id="txtMotherName" name="txtMotherName" type="text" class="form-control" placeholder="Mother Name *"><br>
					</div>
					
					
					<div class="col-lg-6">
						<label>Father Name :</label>
						<input value="<?php echo $fetchQ_res['stud_f_name']; ?>" id="txtFatherName" name="txtFatherName" type="text" class="form-control" placeholder="Father Name *"><br>
					</div>
					
					
					
					<div class="col-lg-6">
						<label>Occupation :</label>
						<input id="txtOccupation" name="txtOccupation" type="text" class="form-control" value="<?php echo $fetchQ_res['stud_occupation']; ?>" placeholder="Occupation *"><br>
					</div>
					
					
					<div class="col-lg-6">
						<label>Organization :</label>
						<input value="<?php echo $fetchQ_res['stud_orgnization']; ?>" id="txtOrgni" name="txtOrgni" type="text" class="form-control" placeholder="Organization *"><br>
					</div>
					
				<div class="col-lg-12">	
					<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Personal Details </h4><br>
					
					<label>Correspondence Address : </label>
					<textarea id="txtCmpleteAdd" name="txtCmpleteAdd" class="form-control" placeholder="Correspondence Address"><?php echo $fetchQ_res['stud_add']; ?></textarea>
					
					<br>
					
				</div>					
				

				
				<div class="col-lg-4">
				
				<label>DOB : </label>
					<input id="txtDOB" name="txtDOB" type="date" class="form-control" value="<?php echo $fetchQ_res['stud_dob']; ?>"><br>
					</div>
				
				<div class="col-lg-4">
					<label>Marital Status : </label>
					<input id="txtMateriState" value="<?php echo $fetchQ_res['stud_marital']; ?>" name="txtMateriState" type="text" class="form-control" placeholder="Marital Status"><br>
				
				</div>
				
				<div class="col-lg-4">
					<label>Gender:  </label>
					<input value="<?php echo $fetchQ_res['stud_gender']; ?>" id="txtGender" name="txtGender" type="text" class="form-control" placeholder="Gender "><br>
				</div>
				
				
				
				<div class="col-lg-4">
					<label>City : </label>
					<input value="<?php echo $fetchQ_res['stud_city']; ?>" id="txtCity" name="txtCity" type="text" class="form-control" placeholder="City"><br>
				</div>
				
				
				<div class="col-lg-4">
					<label>Pin : </label>
					<input value="<?php echo $fetchQ_res['stud_pin']; ?>" id="txtPin" name="txtPin" type="text" class="form-control" placeholder="Pin "><br>
				</div>
				
				
				<div class="col-lg-4">
					<label>State : </label>
					<input  value="<?php echo $fetchQ_res['stud_state']; ?>" id="txtState" name="txtState" type="text" class="form-control" placeholder="State "><br>
				</div>
				
				
				
				<div class="col-lg-4">
				<label>Email ID : </label>
					<input value="<?php echo $fetchQ_res['stud_email']; ?>" id="txtEmail" name="txtEmail" type="text" class="form-control" placeholder="Email ID"><br>
					
				</div>
				
				
				<div class="col-lg-4">
				<label>Mobile : </label>
					<input value="<?php echo $fetchQ_res['stud_mo']; ?>" id="txtMo" name="txtMo" type="text" class="form-control" placeholder="Mobile "><br>
					
				</div>
				
				<div class="col-lg-3">
				<label>Aadhar Card No : </label>
					<input value="<?php echo $fetchQ_res['stud_aadhr']; ?>" id="txtAdhrNo" name="txtAdhrNo" type="file" class="form-control" placeholder="Aadhar Card No  "><br>
					
				</div>
                
                <div class="col-lg-1"><br>
                	<img src="../../stud_aadhar/<?php echo $fetchQ_res['id'].".".$fetchQ_res['stud_aadhr']; ?>" style="width:40px; height:40px;">
                </div>
				
				
				<div class="col-lg-12">
					<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Educational Qualifications: (Write Last Qualification)</h4><br>
					
				
                
                <table class="table table-bordered table-responsive">
                	<thead>
                    	<tr>
                        	<th>Qualification</th>
                            <th>School/College/Institute</th>
                            <th>Board/University</th>
                            <th>Year of Passing</th>
                            <th>Division % Marks</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                    	<tr>
                        	<td>
                            	<input id="tenQuli" name="tenQuli" type="text" class="form-control" placeholder="Qualification" value="<?php echo $fetchQ_res['stud_ten_quali']; ?>">
                            </td>
                            <td>
                            
                            	<input value="<?php echo $fetchQ_res['stud_ten_school']; ?>" id="tenschClg" name="tenschClg" type="text" class="form-control" placeholder="School/College/Institute">
                            </td>
                            <td>
                            	<input value="<?php echo $fetchQ_res['stud_ten_board']; ?>" id="tenbordUni" name="tenbordUni" type="text" class="form-control" placeholder="Board/University">
                            </td>
                            <td>
                      			<input value="<?php echo $fetchQ_res['stud_ten_yop']; ?>" id="tenyearPass" name="tenyearPass" type="text" class="form-control" placeholder="Year of Passing">                                 
                            </td>
                            <td>
                            
                            	<input value="<?php echo $fetchQ_res['stud_ten_mark']; ?>" id="tenDiviMark" name="tenDiviMark" type="text" class="form-control" placeholder="Division % Marks">                       
                                
                            </td>
                            <!--<td>
                            	<input id="tenDocument" name="tenDocument" type="file" class="form-control">
                                <?php //if($fetchQ_res['stud_ten_doc']=="" || $fetchQ_res['stud_ten_doc']==NULL){ } else { ?>
                                <a  target="_blank" href="../../stud_documents/<?php //echo $fetchQ_res['stud_ten_doc']; ?>">download</a>
                            <?php //} ?>
                            </td>-->
                        </tr>
                        
                        
                        
                        <tr>
                        	<td>
                            	<input value="<?php echo $fetchQ_res['stud_ele_quali']; ?>" id="twelQuli" name="twelQuli" type="text" class="form-control" placeholder="Qualification">
                            </td>
                            <td>
                            	<input value="<?php echo $fetchQ_res['stud_ele_school']; ?>" id="twelschClg" name="twelschClg" type="text" class="form-control" placeholder="School/College/Institute">
                            </td>
                            <td>
                            
                            	<input value="<?php echo $fetchQ_res['stud_ele_board']; ?>" id="twelbordUni" name="twelbordUni" type="text" class="form-control" placeholder="Board/University">
                            </td>
                            <td>
                      			<input value="<?php echo $fetchQ_res['stud_ele_yop']; ?>" id="twelyearPass" name="twelyearPass" type="text" class="form-control" placeholder="Year of Passing">                                 
                            </td>
                            <td>
                            
                            	<input value="<?php echo $fetchQ_res['stud_ele_mark']; ?>" id="twelDiviMark" name="twelDiviMark" type="text" class="form-control" placeholder="Division % Marks">                       
                                
                            </td>
                           <!-- <td>
                            	<input id="twelDocument" name="twelDocument" type="file" class="form-control">
                                 <?php //if($fetchQ_res['stud_ele_doc']=="" || $fetchQ_res['stud_ele_doc']==NULL){ } else { ?>
                                <a target="_blank" href="../../stud_documents/<?php //echo $fetchQ_res['stud_ele_doc']; ?>">download</a>
                            <?php //} ?>
                            
                            </td>-->
                        </tr>
                        
                        
                        <tr>
                        	<td>
                            	<input id="clgQuli" name="clgQuli" type="text" class="form-control" value="<?php echo $fetchQ_res['stud_clg_quali']; ?>" placeholder="Qualification">
                            </td>
                            <td>
                            
                            	<input value="<?php echo $fetchQ_res['stud_clg_school']; ?>" id="clgschClg" name="clgschClg" type="text" class="form-control" placeholder="School/College/Institute">
                            </td>
                            <td>
                            	<input id="clgbordUni" name="clgbordUni" type="text" class="form-control" value="<?php echo $fetchQ_res['stud_clg_board']; ?>" placeholder="Board/University">
                            </td>
                            <td>
                      			<input value="<?php echo $fetchQ_res['stud_clg_yop']; ?>" id="clgyearPass" name="clgyearPass" type="text" class="form-control" placeholder="Year of Passing">                                 
                            </td>
                            <td>
                            
                            	<input id="clgDiviMark" name="clgDiviMark" type="text" class="form-control" placeholder="Division % Marks" value="<?php echo $fetchQ_res['stud_clg_mark']; ?>">                       
                                
                            </td>
                           <!-- <td>
                            	<input id="clgDocument" name="clgDocument" type="file" class="form-control">
                                <?php //if($fetchQ_res['stud_clg_doc']=="" || $fetchQ_res['stud_clg_doc']==NULL){ } else { ?>
                                <a  target="_blank" href="../../stud_documents/<?php //echo $fetchQ_res['stud_clg_doc']; ?>">download</a>
                            <?php //} ?>
                            </td>-->
                        </tr>                   
                    </tbody>
                    
                </table> 
                
                	
					
				</div>
                
                   
                <div class="col-lg-12">
                	<label>Documents : </label>
                    <input type="file" name="txtDocFile" name="txtDocFile" class="form-control" required>
                    <?php if($fetchQ_res['stud_document']=="" || $fetchQ_res['stud_document']==NULL){ ?> <span  class="pull-right" >no document uploaded </span><?php } else {   ?>
                    <a class="pull-right" target="_blank" download href="../../stud_documents/<?php echo $fetchQ_res['stud_document']; ?>">download document !..</a>
                  <?php } ?>  
                    <br>
                </div>
                
                
                
                
    </form>            
            
     <?php
	
}
else{

	
	
 } ?>          
                <div class="col-lg-12">
                <br>
                	<p align="center">
                    	<button class="btn btn-sm btn-info studInfoSubmit">Submit</button>
                    </p>
                    <br><br>
                </div>
                
                
				
                   </div>
                </div>
            </div>
        </div>
    </div>
	<style>
	.c_sec{
		float:left; margin-right:10px; margin-bottom:10px; padding:5px; color:#fff; background:#333;
	}
	</style>
	
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
    <script>
	$(".studInfoSubmit").on("click",function(e){
		if($("#txtNOfAppli").val()=="" || $("#txtNOfAppli").val()==null){
			$("#txtNOfAppli").focus();
		}
		else if($("#txtMotherName").val()=="" || $("#txtMotherName").val()==null){
			$("#txtMotherName").focus();
		}
		else if($("#txtFatherName").val()=="" || $("#txtFatherName").val()==null){
			$("#txtFatherName").focus();
		}
		else if($("#txtCmpleteAdd").val()=="" || $("#txtCmpleteAdd").val()==null){
			$("#txtCmpleteAdd").focus();
		}
		else{
			
			
				$("#studentInfoFrm").submit();
			
			
		}
	});
	</script>
    
    
	<script>
	$("#txtSelTrainingInstitute").on("change",function(e){
				
		$("#course_res").html("");
		
		if($("#txtSelTrainingInstitute option:selected").val()=="i_n"){
			alert("please select institute !...");
		}
		else{
			var i_name=$("#txtSelTrainingInstitute option:selected").val();
			i_name=i_name.split("|");
			i_name=i_name[0];
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
							
							
							
							empty_c_name=empty_c_name+"<option value='"+r_data[i].id+"|"+r_data[i].c_name+"'>"+r_data[i].c_name+"-"+r_data[i].c_duration+"</option>";
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