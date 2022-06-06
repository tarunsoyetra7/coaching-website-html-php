<?php
	if(isset($_COOKIE['login']))
	{	
		require("../../root/db_connection.php");
		if(isset($_REQUEST['del_id'])){	
			$del_id=$_REQUEST['del_id'];
			$q=$db->query("update  user_infromation set delstatus=1 where user_id=$del_id");
			?>
            	<script>
					alert("Sucessfully Deleted !...");
					window.location.replace('add_employee.php');
				</script>
            <?php	
		}
		else{
		?>
			<script>
				alert("Try Again !....");
				window.location.replace('add_employee.php');
			</script>
		<?php
		} 
	}
	else
	{
		header("location:../index.php");	
	}
?>