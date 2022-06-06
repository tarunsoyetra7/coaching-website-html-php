<?php
if(isset($_COOKIE['login']))
{	
	require("../../root/db_connection.php");
	$del_id=$_REQUEST['del_id'];
	
	$delQ=$db->query("update student_master set flag='false' where id=$del_id") or die("");
	
	echo "Sucessfully Deleted !...";

}

else
{

	header("location:../index.php");	
}

?>