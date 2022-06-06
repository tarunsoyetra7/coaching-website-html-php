<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['del_id'])){
		$del_id=str_Replace("'","",$_REQUEST['del_id']);
		$delQ=$db->query("update req_req set flag='false' where id=$del_id ") or die("");
		?>
			<script>
				alert("Sucessfully Deleted !...");
				window.location.replace("all_course_reg_req.php");
			</script>
		<?php
	}
	else{
		echo "Try Agin !...";
	}	
}
else
{
	header("location:../index.php");	
}
?>