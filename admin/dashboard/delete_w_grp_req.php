<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['cur_id'])){
		$cur_id=str_Replace("'","",$_REQUEST['cur_id']);
		$delQ=$db->query("delete from whats_app_update where id=$cur_id ") or die("");
		echo "Sucessfully Deleted !...";
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