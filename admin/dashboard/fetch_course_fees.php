<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");	
	$cur_val=str_replace("'","",$_REQUEST['cur_val']);
	$fetchQ=$db->query("SELECT  c_fees FROM course_master WHERE id=$cur_val") or die("");
	$fetchQ_res=$fetchQ->fetch(PDO::FETCH_ASSOC);
	echo $c_fee=$fetchQ_res['c_fees'];	
}
else
{
	header("location:../index.php");	
}
?>