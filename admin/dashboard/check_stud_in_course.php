<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");
	$course_val=str_replace("'","",$_REQUEST['course_val']);
	
	$course_val=explode("|",$course_val);
	
	$insID=$course_val[0];	
	$courseID=$course_val[1];
	
	
	$chkQ=$db->query("SELECT COUNT(id) as total_count FROM student_master WHERE institut_id=$insID AND course_id=$courseID") or die("");
	
	$chkQ_res=$chkQ->fetch(PDO::FETCH_ASSOC);
	
	if($chkQ_res['total_count']==0){
		echo "no_stud";
	}
	else{
		echo "stud";
	}
}
else
{
	header("location:../index.php");	
}
?>