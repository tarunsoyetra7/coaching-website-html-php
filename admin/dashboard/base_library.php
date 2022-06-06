<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	
	$eid=$_REQUEST['cur_id'];
	 $query1=$db->query("
 SELECT SUM(amount) as amount FROM recipt_master WHERE created_by=$eid") or die("");
 $result1=$query1->fetch(PDO::FETCH_ASSOC);
 $recAmnt=$result1['amount'];
 
 $query2=$db->query("
 SELECT SUM(amount) as amount FROM recipt_master WHERE frm_emp_id=$eid") or die("");
 $result2=$query2->fetch(PDO::FETCH_ASSOC);
 $givenAmnt=$result2['amount'];
 
 echo $recAmnt-$givenAmnt; 


	
}
else{
	header("location:../index.php");	
}
	
?>