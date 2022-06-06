

<?php
if(isset($_COOKIE['login']))
{

require("../../root/db_connection.php");

?>

<?php
$event_title=$_REQUEST['event_title'];
$event_title1=str_replace("'","",$event_title);
$txtHide=$_REQUEST['txtHide'];



$q=$db->query("update event set event_title='$event_title1' where event_id=$txtHide") or die("error");

/*$q=mysql_query("insert into photo(photo_ext,select_event_id)
values('$img_ext','$event_name')")
 
 or die("Error");
 */

?>

<script>
alert('Record Saved Successfully');
window.location.replace('manage-event.php');
</script>


<?php
}

else
{

	header("location:../index.php");	
}

?>

