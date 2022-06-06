<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['deleteImageId'])){
		$cur_id=str_Replace("'","",$_REQUEST['deleteImageId']);
		$delQ=$db->query("delete from event_image where img_id=$cur_id") or die("");
		echo "Sucessfully Deleted !...";
		
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