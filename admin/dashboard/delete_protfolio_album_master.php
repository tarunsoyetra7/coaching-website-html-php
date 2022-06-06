<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$del_id=$_REQUEST['del_id'];
	$q1=$db->query("delete from portfolio_album where id=$del_id") or die("error1");
?>
	<script>
        alert('Record Successfully Deleted');
        window.location.replace('portfolio_album_master.php');
    </script>
<?php
}
else
{
	header("location:../index.php");	
}
?>