<?php
if(isset($_COOKIE['login']))
{
require("../../root/db_connection.php");
$delID=$_REQUEST['v_id'];
		
			$q1=$db->query("update user_query set flag='false' where id=$delID") or die("error1");
		
		if($q1==TRUE){
			echo "success";
		}
		else{
			echo "error";
		}
}

else
{

	header("location:../index.php");	
}

?>
