<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	if(isset($_REQUEST['del_id'])){
		
		$del_id=str_replace("'","",$_REQUEST['del_id']);
		$delQ=$db->query("delete from authentication where a_id=$del_id") or die("");
		if($delQ==TRUE){
			?>
        	<script>
				alert("Sucessfully Deleted !");
				window.location.replace("add_web_pages.php");
			</script>
        <?php
		}
		else{
			?>
        	<script>
				alert("Try Again !");
				window.location.replace("add_web_pages.php");
			</script>
        <?php
		}
		
	}else{
		?>
        	<script>
				alert("Try Again !");
				window.location.replace("add_web_pages.php");
			</script>
        <?php
	}
}
else
{
	header("location:../index.php");	
}
?>
