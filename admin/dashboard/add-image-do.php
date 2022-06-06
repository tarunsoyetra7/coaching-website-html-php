

<?php
if(isset($_COOKIE['login']))
{

require("../../root/db_connection.php");

?>

<?php
$event_name=$_REQUEST['event_name'];

$event_image=$_FILES['event_image']['name'];



foreach($_FILES['event_image']['tmp_name'] as $key => $tmp_name ){
	
		$file_name = $key.$_FILES['event_image']['name'][$key];
		$file_size =$_FILES['event_image']['size'][$key];
		$file_tmp =$_FILES['event_image']['tmp_name'][$key];
		$file_type=$_FILES['event_image']['type'][$key];	
		$img_ext= pathinfo($file_name,PATHINFO_EXTENSION);
		
		
if($img_ext=="jpg" || $img_ext=="png" || $img_ext=="jpeg"){

		$check = getimagesize($_FILES['event_image']['tmp_name'][$key]);

		if(($check[0]>800) && (500<$check[1]))    //check file width and height of an image
		{
			echo "<script>alert('Please Upload image with below width 800px and height 500px.');
				window.location.replace('add-image.php');
			</script>";
			exit(0);
		}
       

$q=$db->query("insert into event_image(img_ext,select_event_id)
values('$img_ext','$event_name')") or die("error");

/*$q=mysql_query("insert into photo(photo_ext,select_event_id)
values('$img_ext','$event_name')")
 
 or die("Error");
 */

 $lastID= $db->lastInsertId();
 
 $imageNewName=$lastID.".".$img_ext;
 
 move_uploaded_file($file_tmp,"../../event-image//".$imageNewName);
	
}
else
{
	?>
    	<script>
			alert("Allowed File Type jpn,png,jpeg");
			window.location.replace("add-image.php");
		</script>
    <?php
}
}


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

