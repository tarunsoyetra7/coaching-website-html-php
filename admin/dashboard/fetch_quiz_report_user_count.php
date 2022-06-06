<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	$cur_id=$_REQUEST['cur_id'];
	$newQ=$db->query("SELECT quiz_id AS total_count FROM quiz_res_detail WHERE quiz_id=$cur_id");
	$totalCount=$newQ->rowCount();	
	echo $totalCount." users";
}
else
{
	header("location:../index.php");	
}
?>