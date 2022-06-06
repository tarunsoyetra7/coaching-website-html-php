<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$instituteID=$_REQUEST['txtSelTrainingInstitute'];
	$newsImg=$_FILES['newsImg']['name'];
	$newsImgExt=pathinfo($newsImg,PATHINFO_EXTENSION);
	$title=$_REQUEST['title'];
	$title1=str_replace("'","",$title);
	$date=$_REQUEST['date'];
	$descp=$_REQUEST['descp'];
	$descp1=str_replace("'","",$descp);
	
	
	
	/*---code for email---*/

if($instituteID==0){
	$emailCondi="";
}
else{
	$emailCondi="id=$instituteID AND";
}
$fetchEmailQ=$db->query("SELECT GROUP_CONCAT(o_email_id) AS o_email_id FROM center_info_master WHERE  $emailCondi  flag='true'") or die("");	
	
$fetchEmailQ_res=$fetchEmailQ->fetch(PDO::FETCH_ASSOC);	

$finalEmailID=$fetchEmailQ_res['o_email_id'];

// the message
$msg = "News Title : ".$title1."\n News Descp : ".$descp1."";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email

$recipients = array($finalEmailID
  // more emails
);

$email_to = implode(',', $recipients); // your email address

for($i=0; $i<=count($email_to); $i++){
if($email_to[$i]==""){ } else {
mail($email_to,$title1,$msg);
}
}


	
	/*---end code for email----*/
	
	
	if($newsImgExt=="" || $newsImgExt==NULL || $newsImgExt=="jpg" || $newsImgExt=="png" || $newsImgExt=="jpeg" || $newsImgExt=="pdf" || $newsImgExt=="docx" || $newsImgExt=="JPG" || $newsImgExt=="PNG" || $newsImgExt=="JPEG" || $newsImgExt=="PDF" || $newsImgExt=="DOCX" || $newsImgExt=="rar" || $newsImgExt=="RAR" || $newsImgExt=="zip" || $newsImgExt=="ZIP")
	{
		$q=$db->query("insert into news_and_updates(institute_id,news_title,news_date,news_Descp,news_img_ext)
values('$instituteID','$title1','$date','$descp1','$newsImgExt')") or die("error");
		$lastID=$db->lastInsertId();
		$newImgName=$lastID.".".$newsImgExt;
		move_uploaded_file($_FILES['newsImg']['tmp_name'],"../../newsImage//".$newImgName);
	}
	else{
	?>
    	<script>
				alert("Invalid file format !...");
				window.location.replace("add-news-updates.php");
		</script>
    <?php
		}
	?>
	<script>
		alert('Record Saved Successfully');
		window.location.replace('manage-news-updates.php');
    </script>
<?php
}
else
{
	header("location:../index.php");	
}
?>