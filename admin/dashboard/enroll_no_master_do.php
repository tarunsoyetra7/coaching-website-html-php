<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	
	$txtEnroll=str_replace("'","",$_REQUEST['txtEnroll']);
	$txtHide=$_REQUEST['txtHide'];
	
	if($txtHide=="" || $txtHide==NULL){
		$enrollQ=$db->query("insert into enroll_master(enroll_no,created_by,created_on) values('$txtEnroll',$login_id,now())");
		?>
        	<script>
				alert("Sucessfully Created !...");
				window.location.replace("enroll_no_master.php");
			</script>
        <?php
	}
	else{
		$updateQ=$db->query("update enroll_master set enroll_no='$txtEnroll',updated_by=$login_id,updated_on=now() where id=$txtHide");
		?>
        	<script>
				alert("Sucessfully Updated !..");
				window.location.replace("enroll_no_master.php");
			</script>
        <?php
	}		
}
else
{
	header("location:../index.php");	
}
?>