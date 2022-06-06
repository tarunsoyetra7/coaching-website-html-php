

<?php
if(isset($_COOKIE['login']))
{
	$login_id=$_COOKIE['login'];
require("../../root/db_connection.php");



if(isset($_FILES['event_image']['name'])){
$event_image=$_FILES['event_image']['name'];



foreach($_FILES['event_image']['tmp_name'] as $key => $tmp_name ){
	
		$file_name = $key.$_FILES['event_image']['name'][$key];
		$file_size =$_FILES['event_image']['size'][$key];
		$file_tmp =$_FILES['event_image']['tmp_name'][$key];
		$file_type=$_FILES['event_image']['type'][$key];	
		$img_ext= pathinfo($file_name,PATHINFO_EXTENSION);
		
		
if($img_ext=="jpg" || $img_ext=="png" || $img_ext=="jpeg" || 
$img_ext=="JPG" || $img_ext=="PNG" || $img_ext=="JPEG" || $img_ext=="pdf" || $img_ext=="PDF" || $img_ext=="doc"
|| $img_ext=="DOC" || $img_ext=="docx" || $img_ext=="DOCX" || $img_ext=="xls" || $img_ext=="XLS" || $img_ext=="txt"
|| $img_ext=="TXT"){

		

$q=$db->query("insert into website_files(file_ext,created_by,created_on)
values('$img_ext',$login_id,NOW())") or die("error");


 $lastID= $db->lastInsertId();
 
 $imageNewName=$lastID.".".$img_ext;
 
 move_uploaded_file($file_tmp,"../../website_files/".$imageNewName);
	
}
else
{
	?>
    	<script>
			alert("Invalid File FOrmat !...");
			window.location.replace("file_upload_master.php");
		</script>
    <?php
}
}


?>

<script>
alert('Record Saved Successfully !...');
window.location.replace('file_upload_master.php');
</script>
<?php

}
else{
	?>
	<script>
alert('Try Again !...');
window.location.replace('file_upload_master.php');
</script>
	<?php
}
}
else
{
	header("location:../index.php");	
}
?>

