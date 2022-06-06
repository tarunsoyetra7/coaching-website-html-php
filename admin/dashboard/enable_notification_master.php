<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['cur_id'])){
		$cur_id=str_Replace("'","",$_REQUEST['cur_id']);
		$delQ=$db->query("update notification_master set e_d_optn='true',updated_by=$login_id,updated_on=CURDATE() where id=$cur_id ") or die("");
		echo "Sucessfully Enabled !...";
	}
	else{
		echo "Try Agin !...";
	}	
}
else
{
	header("location:../index.php");	
}
?>