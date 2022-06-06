<?php
if(isset($_COOKIE['login']))
{
require("../../root/db_connection.php");
$delID=$_REQUEST['delID'];

		if(isset($_REQUEST['newsImgExt']))
		{
			$imgExt=$_REQUEST['newsImgExt'];
			$imgName=$delID.".".$imgExt;
			$path="../../newsImage/".$imgName;
			unlink($path);
			$q1=$db->query("delete from news_and_updates where news_id=$delID") or die("error1");
		}
		else
		{
			$q1=$db->query("delete from news_and_updates where news_id=$delID") or die("error1");
		}
	

?>

<script>
alert('Record Successfully Deleted');
window.location.replace('manage-news-updates.php');
</script>


<?php
		

}

else
{

	header("location:../index.php");	
}

?>
