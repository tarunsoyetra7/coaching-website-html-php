<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['deleteID'])){
		$cur_id=str_Replace("'","",$_REQUEST['deleteID']);
		$delQ=$db->query("delete from event where event_id=$cur_id") or die("");
		
		?>
		<script>
		alert("Successfully Deleted");
		window.location.replace("manage-event.php");
		</script>
		<?php
	}
	else{
		?>
		<script>
		alert("Try Agin !...");
		window.location.replace("manage-event.php");
		</script>
		<?php
	}	
}
else
{
	header("location:../index.php");	
}
?>