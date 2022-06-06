<?php
if(isset($_COOKIE['login']))
{
	$login_id=$_COOKIE['login'];	
	require("../../root/db_connection.php");
	//echo $_REQUEST['del_id'];
	$del_id=explode("-",$_REQUEST['del_id']);
	
	$institute_id=$del_id[0];	
	$created_by_id=$del_id[1];	
	$updated_by_id=$login_id;	
	
	$delQ=$db->query("update center_info_master set flag='false',updated_by=$login_id,updated_on=now() where id=$institute_id") or die("");
	
	
	/*---delete /updated student record---*/
	
	$fetchStud=$db->query("update student_master set flag='false',updated_by=$updated_by_id,updated_on=now() where institut_id=$institute_id and created_by=$created_by_id");
	
	
	echo "Sucessfully Deleted !...";

}

else
{

	header("location:../index.php");	
}

?>