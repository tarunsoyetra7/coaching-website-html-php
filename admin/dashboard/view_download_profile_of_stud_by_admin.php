<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	$id=str_replace("'","",$_REQUEST['id']);
	
	$upQ=$db->query("update tmp_stud_profile set vari_status='true' where id=$id") or die("");
	
	if($upQ==TRUE){
		echo "Suessfully Viewed !..";
	}
	else
	{
		echo "Try Again!...";
	}
	
}
else
{
	header("location:../index.php");	
}
?>