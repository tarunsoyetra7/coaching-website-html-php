<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");		
	$id=str_replace("'","",$_REQUEST['id']);
	
	
	$reqQ=$db->query("UPDATE user_request SET req_status='true' WHERE id=$id") or die("");
	
	if($reqQ==TRUE){
	echo "success";
	}
	else
	{
		echo "error";
	}
	
	
}
else
{
	header("location:../index.php");	
}
?>