<?php
	if(isset($_COOKIE['login'])){	
		require("../../root/db_connection.php");
		if(isset($_REQUEST['id'])){	
			$del_id=$_REQUEST['id'];
			$q=$db->query("update  batch_master set flag='false' where id=$del_id");
			?>
            	<script>
					alert("Sucessfully Deleted !....");
					window.location.replace("batch_master.php");
				</script>
            <?php
		}
		else{	?>
					<script>
						alert("Try Again !...");
	     				window.location.replace('batch_master.php'); </script>
			    <?php
		} 
	}
	else{
		header("location:../index.php");	
	}
?>