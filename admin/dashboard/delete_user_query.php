<?php
if(isset($_COOKIE['login']))
{
require("../../root/db_connection.php");
$delID=$_REQUEST['delID'];

		
			$q1=$db->query("delete from user_query  where id=$delID") or die("error1");
		

?>

<script>
alert('Record Successfully Deleted');
window.location.replace('user_query_page.php');
</script>


<?php
		

}

else
{

	header("location:../index.php");	
}

?>
