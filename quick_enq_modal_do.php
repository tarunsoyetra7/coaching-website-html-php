<?php include("root/db_connection.php"); 
if(isset($_REQUEST['first_name']) &&  isset($_REQUEST['phone'])){	
	$first_name=str_replace("'","",$_REQUEST['first_name']);	
	$phone=str_replace("'","",$_REQUEST['phone']);		
	$insQ=$db->query("insert into quick_enquiry_master(user_name,user_mo,created_on) values('$first_name','$phone',now())") or die("");
	$admin_id=$phone;
	$expireTime=time()+60*60*24*30;
	setcookie("quick_modal",$admin_id,$expireTime);	
	echo "s";			
}
else{
	echo "err";
}
?>