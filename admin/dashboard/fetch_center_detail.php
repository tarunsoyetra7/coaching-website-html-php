<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	
	$loginTypeQ=$db->query("select login_type from user_infromation where user_id=$login_id") or die("");
		
		$loginTypeQ_res=$loginTypeQ->fetch(PDO::FETCH_ASSOC);
		$login_type=$loginTypeQ_res['login_type'];
		
		if($login_type=="sadmin"){
			$fetch_condition="";
			
		}
		else{
			$fetch_condition="AND center_info_master.created_by=$login_id";
		}
		
		
	
	//$id=str_replace("'","",$_REQUEST['id']);
	
	
	$institute_ID=$_REQUEST['institute_ID'];
	$course_ID=$_REQUEST['course_ID'];
	
	
	$fetchQ=$db->query("SELECT student_master.id, 
       center_info_master.t_c_name AS institute_name,
       center_info_master.id AS institut_id, 
        
        (SELECT GROUP_CONCAT(c_name) FROM course_master WHERE id=$course_ID ) AS course_name,
      
       student_master.stud_image, 
       student_master.stud_name, 
       stud_mo, 
       stud_m_name, 
       stud_f_name 
FROM   student_master, 
       center_info_master 
WHERE  center_info_master.id = student_master.institut_id 
        AND center_info_master.id=$institute_ID AND student_master.course_id=$course_ID
ORDER  BY student_master.id DESC ") or die("");
	
	if($fetchQ==TRUE){
		if($fetchQ->rowCount()==0){
			echo json_encode("");
		}
		else{
			while($fetchQ_res=$fetchQ->fetch(PDO::FETCH_ASSOC)){
				$fetchArray[]=$fetchQ_res;
			}
			echo json_encode($fetchArray);
		}
	}
	else{
		echo json_encode("");
	}
	
}
else
{
	header("location:../index.php");	
}
?>