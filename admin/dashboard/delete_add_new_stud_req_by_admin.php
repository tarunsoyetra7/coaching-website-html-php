<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");		
	$id=str_replace("'","",$_REQUEST['id']);
	
	//echo "UPDATE tmp_center_info_master SET flag='false',updated_by=$login_id WHERE id=$id";
	
	$updateQ=$db->query("UPDATE tmp_student_master SET flag='false',updated_on=now(),updated_by=$login_id WHERE id=$id") or die("");
	
	if($updateQ==TRUE){
			
		?>
        	<script>
				alert("Sucessfully Deleted !...");
				window.location.replace("report_page.php");
			</script>
        <?php
	}
	else{
		?>
        	<script>
				alert("Try Again !...");
				window.location.replace("report_page.php");
			</script>
        <?php
	}		
}
else
{
	header("location:../index.php");	
}
?>