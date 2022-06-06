

<?php
if(isset($_COOKIE['login']))
{
	 

require("../../root/db_connection.php");

?>

<?php
$institute_id=$_REQUEST['txtSelTrainingInstitute'];



$newsImg=$_FILES['newsImg']['name'];
$newsImgExt=pathinfo($newsImg,PATHINFO_EXTENSION);

$title=$_REQUEST['title'];
$title1=str_replace("'","",$title);

$date=$_REQUEST['date'];

$descp=$_REQUEST['descp'];
$descp1=str_replace("'","",$descp);


$txtHide=$_REQUEST['txtHide'];

if($newsImgExt=="")
{
	$q=$db->query("update news_and_updates set institute_id='$institute_id', news_title='$title1',news_date='$date', news_Descp='$descp1' where news_id=$txtHide") or die("error");
	?>
    	<script>
			alert("Sucessfully Saved !...");
			window.location.replace("add-news-updates.php");
		</script>
    <?php
}
else
{
	$q=$db->query("update news_and_updates set institute_id='$institute_id', news_title='$title1',news_date='$date', news_Descp='$descp1',news_img_ext='$newsImgExt' where news_id=$txtHide") or die("error");
	
	$newImageName=$txtHide.".".$newsImgExt;
	move_uploaded_file($_FILES['newsImg']['tmp_name'],"../../newsImage//".$newImageName);
	
	?>
    	<script>
			alert("Sucessfully Updated !...");
			window.location.replace("edit-news-updates.php?editID=<?php echo $txtHide; ?>");
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

