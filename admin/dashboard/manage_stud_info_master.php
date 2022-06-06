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
			$fetch_condition="AND center_info_master.created_by=$login_id";
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
    
     <link rel="stylesheet" href="css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  
    
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- data tables -->
    <script src="js/jquery.dataTables.min.js"></script>
    

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
                               		 Add Student
                               </a>
                            </li>
                            
                             <li class="active">
                               <a href="import_student_excel_master.php">
                               		 Import Excel 
                               </a>
                            </li>
                            
                           
                        <!--     <li class="active">
                               <a href="add_stud_profile_master.php">
                               		<i class="fa fa-dashboard"></i> Add Student Profile
                               </a>
                            </li>-->
                            
                            <li class="active">
                               <a href="manage_stud_info_master.php">
                               		 Manage Student
                               </a>
                            </li>
                            
                            
                        </ol>
                    </div>
                  
                    
                    <div class="col-lg-1">
                    	
                        
                    </div>
                    
                    <div class="col-lg-5">
                   
<label>Select Training Institute :</label>
						<select class="form-control" id="txtSelTrainingInstitute" name="txtSelTrainingInstitute" autofocus>
                        	<option value="i_n">---Select Training Institute</option>
                            <?php $i_q=$db->query("SELECT id,o_c_n_id, id,t_c_name,t_state,t_city FROM center_info_master WHERE flag='true'   ORDER BY id desc") or die("");
								while($i_q_res=$i_q->fetch(PDO::FETCH_ASSOC)){
							 ?>
                            <option  value="<?php echo $i_q_res['id']."|".$i_q_res['o_c_n_id']; ?>"><?php echo $i_q_res['t_c_name']."-".$i_q_res['t_state']."-".$i_q_res['t_city']; ?></option>
                            <?php } ?>
                        </select>
                     
                        
                    </div>
                     <div class="col-lg-5">
                    <label>Select Course  </label>
                    	<select class="form-control" id="txtSelCourse" name="txtSelCourse"  autofocus>
                        	<option value="s_c">---select course---</option>
                            
                        </select>
                        
                     
                        
                    </div>
                    
                    <div class="col-lg-1"></div>
                    
                    
                    <div class="col-lg-12">
                    
                    <br><br>
                    
                    
                    

<style>
#example1 thead{
	background:#6C7D87; color:#fff;
}

#user_img{
	width:50px; height:50px; margin-right:5px;
}
</style>



 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                                            <thead>

                                                <tr>

                                                    <th>S. No.</th>
<th>Student ID</th>
													<th>Student Profile</th>
                                                    
                                                    <th>Course Name</th>
                                                    <th>Institute Name</th>

                                                    <th>Parent's Name</th>
                                                    
                                                    <th>Contact No</th>

                                                   <th>Option</th>

                                                </tr>

                                            </thead>

                                            <tbody id="stud_fetch_res">

                                                <?php




$q=$db->query("SELECT student_master.id, 
       center_info_master.t_c_name AS institute_name,
       center_info_master.id AS institut_id, 
       (SELECT c_name FROM course_master WHERE id=student_master.course_id) AS course_name, 
       student_master.stud_image, 
       student_master.stud_name, 
       stud_mo, 
       stud_m_name, 
       stud_f_name 
FROM   student_master, 
       center_info_master 
WHERE  center_info_master.id = student_master.institut_id 
          
ORDER  BY student_master.id DESC limit 600") or die("");

                                             
$i=0;
$out="";
                                                while($result = $q->fetch(PDO::FETCH_ASSOC))

                                                {
													
												if($result['stud_image']=="" || $result['stud_image']==NULL){
													$imgURL="../../stud_documents/default_image.jpg";
												}
												else{
													$imgURL="../../stud_documents/".$result['stud_image'];
												}
													
													$i++;   $out.='



                                                    <tr>

                                                           <td>'.$i.'</td>
														   
														   <td>'.$result['id'].'</td>
														   

<td><img src="'.$imgURL.'" id="user_img">'.$result['stud_name'].'</td>


  <td>'.str_replace(",","<br>",$result['course_name']).'</td>




                                                            <td class="nowrap">'.$result['institute_name'].' <a href="training_institute_master.php?id='.$result['institut_id'].'">view</a></td>

                                                        
                                                            
															
															<td><strong>Father Name : </strong>'.$result['stud_f_name'].'<br><strong> Mother Name : </strong>'.$result['stud_m_name'].'</td>
															
															
<td>'.$result['stud_mo'].'</td>

                                                            <td>
  <a href="student_info_master.php?id='.$result['id'].'"><strong>Edit </strong></a>
    
 
                                                           
                                                            

                                                            </td>

                                                    </tr>';

                                                    }

                                                    echo $out;

                                                ?>

                                            </tbody>
 <!--<a href="#" onclick="return DeleteTIM('.$result['id'].')" ><strong>Delete</strong></a>
-->
                                        </table>
                    </div>
                    
                    
                                        
                   </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">    
	$(function () {
	  
		$('#example1').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		   dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
		});
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
			var a=i_name.split("|");			
			i_name=a[1];			
			var insID=a[0];			
			$.ajax({
				type:"POST",				
				data:{insID:insID,id:i_name},
				url:"fetch_course_institute_name.php",
				//dataType:"json",
				//cache:false,				
				success:function(r_data){
					if(r_data=="no course"){
						alert("No Course in Institute... ");
					}
					else{
						/*var empty_c_name="";						
						var f_op="<option value='s_c'>---select course---</option>";
						for(i=0; i<r_data.length; i++){
							empty_c_name=empty_c_name+"<option value='"+insID+"|"+r_data[i].id+"'>"+r_data[i].c_name+"-"+r_data[i].c_duration+"</option>";
						}*/
						//$("#txtSelCourse").html(f_op+empty_c_name);
						$("#txtSelCourse").html(r_data);
					}
				},error:function(err){
					//location.reload();
				}
			});
		}
	});

function DeleteTIM(value){
var r = confirm("Are you sure you really wana to delete !!...");
if (r == true) {	
    $.ajax({
		type:"POST",
		data:{del_id:value},
		url:"delete_stud_master.php",
		success: function(r_data){
			alert(r_data);
			location.reload();
		}
		,error:function(err){
			location.reload();
		}
	});	
} else {   
}		
}
$("#txtSelCourse").on("change",function(e){
	if($("#txtSelCourse option:selected").val()=="s_c"){
		alert("please select course  !....");
		$("#txtSelCourse").focus();
		$("#stud_fetch_res").html("");
	}
	else{
		var cur_id=$("#txtSelCourse option:selected").val();
		var curid_a=cur_id.split("|");
		var institute_ID=curid_a[0];
		var course_ID=curid_a[1];
		
		$.ajax({
			type:"POST",
			data:{institute_ID:institute_ID,course_ID:course_ID},
			url:"fetch_center_detail.php",
			dataType:"json",
			cache:false,
			success: function(r_data){
				if(r_data.length==0){
					alert("no record found !...");
					$("#stud_fetch_res").html("");
				}
				else{
					var j=0;
					var empty_res="";
					for(i=0; i<r_data.length; i++){ j++;
					
					
					if(r_data[i].stud_image=="" || r_data[i].stud_image==null){
						var img_na_me='../../stud_documents/default_image.jpg';
					}
					else{
						var img_na_me='../../stud_documents/'+r_data[i].stud_image;
					}
					
					empty_res=empty_res+"<tr><td>"+j+"</td><td>"+r_data[i].id+"</td><td><img src='"+img_na_me+"' id='user_img'>"+r_data[i].stud_name+"</td><td>"+r_data[i].course_name+"</td><td class='nowrap'>"+r_data[i].institute_name+"<a href='training_institute_master.php?id="+r_data[i].institut_id+"'>view</a></td><td><strong>Father Name : </strong>"+r_data[i].stud_f_name+"<br><strong> Mother Name : </strong>"+r_data[i].stud_m_name+"</td><td>"+r_data[i].stud_mo+"</td><td><a href='student_info_master.php?id="+r_data[i].id+"'><strong>Edit</strong></a> </td></tr>";

					}
					/*| <a href='#' onclick='return DeleteTIM("+r_data[i].id+")'><strong>Delete</strong></a>*/
					$("#stud_fetch_res").html(empty_res);
					
				}
			}
			,error:function(err){
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