

<?php
if(isset($_COOKIE['login']))
{
	?>
    
<?php
 header( 'Content-Type: text/html; charset=utf-8' ); 

require("../../root/db_connection.php");

?>

<?php
if(isset($_REQUEST['edit_id'])){
	$edit_id=$_REQUEST['edit_id'];
	$q=$db->query("select user_id as employee_id,user_name as employee_name,user_pass as employee_pass from user_infromation where user_id=$edit_id");
	while($r=$q->fetch(PDO::FETCH_ASSOC))
	{
		$employee_res[]=$r;	
	}
	echo json_encode($employee_res);
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