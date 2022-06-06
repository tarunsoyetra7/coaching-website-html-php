

<?php
if(isset($_COOKIE['login']))
{
	?>
    
<?php


require("../../root/db_connection.php");

?>

<?php

$event_title=$_REQUEST['event_title'];
$event_title1=str_replace("'","",$event_title);


$q=$db->query("insert into event(event_title)
values('$event_title1')") or die("error");

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

