<?php
if(isset($_COOKIE['login']))
{
	header( 'Content-Type: text/html; charset=utf-8' ); 
	require("../../root/db_connection.php");

	if(isset($_REQUEST['txt_e_name']) && isset($_REQUEST['txtHide']) && isset($_REQUEST['txt_e_pass'])){
	
	$txtHide=$_REQUEST['txtHide'];
	$txt_e_name=$_REQUEST['txt_e_name'];
 
 	$txt_e_pass=$_REQUEST['txt_e_pass'];
 
	$q=$db->query("update user_infromation set user_name='$txt_e_name',user_pass='$txt_e_pass' where user_id=$txtHide") or die("error");
 
 ?>
     <script>
alert("Sucessfully Updated");
window.location.replace('add_employee.php');
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

 
?>


<?php
}

else
{

	header("location:../index.php");	
}

?>