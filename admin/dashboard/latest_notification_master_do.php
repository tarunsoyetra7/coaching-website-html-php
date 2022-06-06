<?php
if(isset($_COOKIE['login']))
{	
$login=$_COOKIE['login'];
	require("../../root/db_connection.php");
	if(isset($_REQUEST['txt_notification'])){			
		$txt_notification=str_replace("'","",$_REQUEST['txt_notification']);
		


$txtHide=$_REQUEST['txtHide'];
if($txtHide=="" || $txtHide==NULL){


$q=$db->query("insert into latest_notification(l_notification,created_by,created_on)
values('$txt_notification','$login',NOW())") or die("");




?>
    	<script>
			alert("Successfully Added !....");
			window.location.replace("latest_information_master.php");
		</script>
    <?php

}

	else{
		
		$updateQ=$db->query("update latest_notification set l_notification='$txt_notification',updated_by='$login',updated_on=NOW() where id=$txtHide") or die("");
		
		?>
        	<script>
				alert("Sucessfully Updated !....");
				swindow.location.replace("latest_information_master.php);
			</script>
        <?php
		
	}
	
}

 
}

else
{

	header("location:../index.php");	
}

?>