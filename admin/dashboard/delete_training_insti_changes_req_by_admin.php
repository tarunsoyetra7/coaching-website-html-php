<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	
	$id=str_replace("'","",$_REQUEST['id']);
	
	$updateQ=$db->query("UPDATE tmp_center_info_master SET flag='false' WHERE institute_id=$id") or die("");
	
	if($updateQ==TRUE){
		echo "Sucessfully Deleted !...";
	}
	else{
		echo "Try Again !....";
	}
	
}
else
{
	header("location:../index.php");	
}
?>