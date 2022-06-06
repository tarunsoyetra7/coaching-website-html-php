<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];	
	$eid=$_REQUEST['cur_id'];	
	
 $query2=$db->query("
 SELECT stud_balance FROM student_master WHERE id=$eid") or die("");
 $result2=$query2->fetch(PDO::FETCH_ASSOC);
 $givenAmnt=$result2['stud_balance']; 
 echo "Total Balance : ".$givenAmnt; 
}
else{
	header("location:../index.php");	
}
	
?>