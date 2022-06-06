<?php
	if(isset($_COOKIE['login']))
	{	
		require("../../root/db_connection.php");
		if(isset($_REQUEST['id'])){	
			$del_id=$_REQUEST['id'];
			$q=$db->query("update  user_infromation set delstatus=0 where user_id=$del_id");
			?>
            	<script>
	            	alert("Sucessfully Restored !....");
					window.location.replace("add_employee.php");
				</script>
            <?php
		}
		else{
		?>
			<script>
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
