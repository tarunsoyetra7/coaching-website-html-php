<?php
if(isset($_COOKIE['login'])){	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");
	$txtBatchName=str_replace("'","",$_REQUEST['txtBatchName']);
	$txtHide=str_replace("'","",$_REQUEST['txtHide']);
	$txtStartDate=str_replace("'","",$_REQUEST['txtStartDate']);	
	if($txtHide=="" || $txtHide==NULL){
		$insQ=$db->query("insert into batch_master(batch_name ,batch_start_date ,created_by ,created_on) values('$txtBatchName','$txtStartDate',$login_id,now())") or die("");		
		?>
        	<script>
				alert("Sucessfully Added !...");
				window.location.replace("batch_master.php");
			</script>
        <?php		
	}
	else{
		$updateQ=$db->query("update batch_master set batch_name='$txtBatchName' ,batch_start_date='$txtStartDate' ,updated_by=$login_id ,updated_on =now() where id=$txtHide") or die("");
		?>
        	<script>
				alert("Sucessfully Update !...");
				window.location.replace("batch_master.php");
			</script>
        <?php
	}	
}
else{
	header("location:../index.php");	
}
?>