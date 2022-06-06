<?php
if(isset($_COOKIE['login']))
{
	
	require("../../root/db_connection.php");

	if(isset($_REQUEST['root_edit_id']))
	{
		$root_edit_id=$_REQUEST['root_edit_id'];
		$q=$db->query("select category_id,category_name,category_image from category_master where category_id=$root_edit_id") or die("error");
		if($q->rowCount()==0){
			echo json_encode("");
		}
		else
		{
			while($r=$q->fetch(PDO::FETCH_ASSOC)){
				$resArray[]=$r;
			}
			echo json_encode($resArray);
		}
	}
	else{
	?>
    <script>
		window.location.replace('category_master.php');
	</script>
    <?php
    }

}
else
{
	header("location:../index.php");	
}
?>