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
                         
                         
                         
                         
  <form name="" method="post" id="studentInfoFrm" enctype="multipart/form-data" action="student_info_master_do_1.php">			
					<div class="col-lg-12">
                    
                    <input type="hidden" value="" id="txtHide" name="txtHide">
                    
                    <input type="hidden" value="<?php echo $edit_id; ?>" id="txtHide1" name="txtHide1">
                    
						<label>Select Training Institute :</label>
						<select class="form-control" id="txtSelTrainingInstitute" name="txtSelTrainingInstitute" autofocus>
                        	<option value="i_n">---Select Training Institute</option>
                            <?php $i_q=$db->query("SELECT o_c_n_id, id,t_c_name,t_state,t_city FROM center_info_master WHERE flag='true' ORDER BY id desc") or die("");
								while($i_q_res=$i_q->fetch(PDO::FETCH_ASSOC)){
									
									if($fetchQ_res['institut_id']==$i_q_res['id']){
										?>
                                        <option selected  value="<?php echo $i_q_res['o_c_n_id']."|".$i_q_res['id']."|".$i_q_res['t_c_name']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                                        <?php
									}
									else{
									
							 ?>
                            <option  value="<?php echo $i_q_res['o_c_n_id']."|".$i_q_res['id']."|".$i_q_res['t_c_name']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <br>
					</div>
					
					
					<div class="col-lg-12">
						<label>Select Name of the Course Applied For :</label>
						<select class="form-control" id="txtSelCourse"  autofocus>
                        	<option value="s_c">---select course---</option>
                            
                            <?php
							$institut_id=$fetchQ_res['institut_id'];
							 $c_q=$db->query("SELECT id,c_name,c_duration FROM course_master WHERE flag='true' ") or die("");
							 
							 while($c_q_res=$c_q->fetch(PDO::FETCH_ASSOC)){
							  ?>
                              
                              <option value="<?php echo $c_q_res['id']."|".$c_q_res['c_name']; ?>"><?php echo $c_q_res['c_name']."-".$c_q_res['c_duration']; ?></option>
                              
                              
                              <?php } ?>
                            
                        </select>
                        <br>
                        
                   <span id="course_res">
                   <?php $c_f_id=$fetchQ_res['course_id'];
				   $c_f_name=$fetchQ_res['course_name'];
				    $c_f_name=explode(",",$c_f_name);
				   $c_f_id=explode(",",$c_f_id);
				   
				   
				   
				   	for($i=0; $i<count($c_f_id); $i++){
						$n_c_id="c_n".$c_f_id[$i];
				    ?>
                   <p class='c_sec' id='<?php echo $n_c_id; ?>' onClick='remove_course("<?php echo $c_f_id[$i]; ?>")'><span id='<?php echo $n_c_id; ?>'><?php echo $c_f_name[$i]; ?></span>&nbsp;<i class='glyphicon glyphicon-remove'></i></p>
                  <?php } ?> 
                   
                  
                   
                   </span>
				   
				   <input type="hidden" value="<?php echo $fetchQ_res['course_id']; ?>" name="txtCourseId" id="txtCourseId">
                   
                   <input value="<?php echo $fetchQ_res['course_name']; ?>" type="hidden" name="txtCourseName" id="txtCourseName">
				   
				   
				   <div style="clear:both;"></div>
                       <br>
					</div>
					
					<div class="col-lg-6">
						<label>Name of Applicant :</label>
						<input type="text" id="txtNOfAppli" name="txtNOfAppli" class="form-control" value="<?php echo $fetchQ_res['stud_name']; ?>" placeholder="Name of Applicant *"><br>
					</div>
					
					<div class="col-lg-5">
						<label>Photograph:</label>
						<input id="txtPhoto" name="txtPhoto" type="file" class="form-control" ><br>
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
				
				<div class="col-lg-4">
				<label>Aadhar Card No : </label>
					<input value="<?php echo $fetchQ_res['stud_aadhr']; ?>" id="txtAdhrNo" name="txtAdhrNo" type="text" class="form-control" placeholder="Aadhar Card No  "><br>
					
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
                           
                        </tr>                   
                    </tbody>
                    
                </table> 
                
                	
					
				</div>
                
                
                
                
                 <div class="col-lg-12">
                	<label>Documents : </label>
                    <input type="file" name="txtDocFile" name="txtDocFile" class="form-control" >
                    <?php if($fetchQ_res['stud_document']=="" || $fetchQ_res['stud_document']==NULL){ ?> <span  class="pull-right" >no document uploaded </span><?php } else {   ?>
                    <a class="pull-right" target="_blank" download href="../../stud_documents/<?php echo $fetchQ_res['stud_document']; ?>">download document !..</a>
                  <?php } ?>  
                    <br>
                </div>
                
                
                
                
    </form>            
            
     <?php
	
}
else{
?>


                        
          
    <?php } ?>          
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
		if($("#txtSelTrainingInstitute option:selected").val()=="i_n"){
			alert("please select training institute!...");
			$("#txtSelTrainingInstitute").focus();
		}		
		else if($("#txtNOfAppli").val()=="" || $("#txtNOfAppli").val()==null){
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
			
			
			var empty_cn_id="";
			var empty_cn_name="";
			for(i=0; i<$("#course_res .c_sec").length; i++)
			{
				var cName=$("#course_res .c_sec span:eq("+i+")").html();
				var cID=$("#course_res .c_sec span:eq("+i+")").attr('id');
				
				empty_cn_id=empty_cn_id+cID+",";
				empty_cn_name=empty_cn_name+cName+",";
				
				
			}
		
			empty_cn_id=empty_cn_id.slice(0,-1);
			empty_cn_name=empty_cn_name.slice(0,-1);
			console.log(empty_cn_id+"----");
			console.log(empty_cn_name+"----");
			
			$("#txtCourseId").val(empty_cn_id);
			$("#txtCourseName").val(empty_cn_name);
		
		
		
		
			if($("#txtCourseId").val()=="" || $("#txtCourseId").val()==null || $("#txtCourseName").val()=="" || $("#txtCourseName").val()==null){
				alert("please select course !...");
				$("#txtSelCourse").focus();
			}
			else{
				$("#studentInfoFrm").submit();
			}
			
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
	
	
	<script>
	$("#txtSelCourse").on("change",function(e){
		var c_name=$("#txtSelCourse option:selected").val();
		
		if($("#txtSelCourse option:selected").val()=="s_c"){
			alert("please select course !...");
		}
		else{
		
		c_name=c_name.split("|");
		var c_id=c_name[0];
		var c_id_1=c_id;
		var c_name=c_name[1];
		c_id="c_n"+c_id;
		var c_struct="<p class='c_sec' id='"+c_id+"' onClick='remove_course("+c_id_1+")'><span id='"+c_id_1+"'>"+c_name+"</span>&nbsp;<i class='glyphicon glyphicon-remove'></i></p>";
		
		$("#course_res").append(c_struct);
		}
		
		
	});
	</script>   
    
    <script>
	function remove_course(id){
		//alert("c_n"+id);
		$("#c_n"+id).remove();
	}
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