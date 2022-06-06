<?php
if(isset($_COOKIE['login']))
{
	
require("../../root/db_connection.php");

$deleteImageId=$_REQUEST['del_id'];

$delete_image_ext=$_REQUEST['del_ext'];

$path="../../website_files/".$deleteImageId.".".$delete_image_ext; 
unlink($path);
$q=$db->query("delete from website_files where id=$deleteImageId") or die("error");
?>

<script>
alert('Successfully Deleted !....');
window.location.replace('file_upload_master.php');
</script>


<?php
}

else
{

	header("location:../index.php");	
}

?>
