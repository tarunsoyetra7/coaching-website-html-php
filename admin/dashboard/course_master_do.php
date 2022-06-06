<?php
if(isset($_COOKIE['login']))
{
	


	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_priority']) &&   isset($_REQUEST['txt_long_descp'])  &&   isset($_REQUEST['txt_shrt_description']) &&   isset($_REQUEST['txt_duration']) &&   isset($_REQUEST['txt_fees'])){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_image=str_replace("'","",$_FILES['txt_image']['name']);
		$img_ext=pathinfo($txt_image,PATHINFO_EXTENSION);
		
		$txt_long_descp=str_replace("'","",$_REQUEST['txt_long_descp']);
		$txt_shrt_description=str_replace("'","",$_REQUEST['txt_shrt_description']);		
		$txt_priority=str_replace("'","",$_REQUEST['txt_priority']);		
		$txt_duration=str_replace("'","",$_REQUEST['txt_duration']);		;
		$txt_fees=str_replace("'","",$_REQUEST['txt_fees']);		;
		
		$cur_date=date("Y-m-d");
			if($img_ext=="" || $img_ext==NULL || $img_ext=="jpg" || $img_ext=="JPG" || $img_ext=="png" || 
				$img_ext=="PNG" || $img_ext=="jpeg" || $img_ext=="JPEG"){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("INSERT INTO course_master(c_title,c_img,c_duration,c_fees,c_s_descp,c_l_descp,c_priority,created_by,created_on) VALUES('$txt_title','$img_ext','$txt_duration','$txt_fees',
'$txt_shrt_description','$txt_long_descp','$txt_priority',$login_id,'$cur_date')") or die("gdjh");
					
					$lastID=$db->lastInsertId();
					$img_name=$lastID.".".$img_ext;
					move_uploaded_file($_FILES['txt_image']['tmp_name'],"../../course_master/".$img_name);
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("course_master.php");
			</script>
					<?php
				}
				else{
					
					if($img_ext=="" || $img_ext==NULL){
						$img_condition="";
					}
					else{
						$img_condition=",c_img='$img_ext'";
						$lastID=$txt_hide;
					$img_name=$lastID.".".$img_ext;
					move_uploaded_file($_FILES['txt_image']['tmp_name'],"../../course_master/".$img_name);
					}
					
					$updateQ=$db->query("update course_master set  c_title='$txt_title' 
					$img_condition ,c_duration='$txt_duration',c_fees='$txt_fees',c_s_descp='$txt_shrt_description',c_l_descp='$txt_long_descp',c_priority='$txt_priority' ,updated_by=$login_id ,updated_on='$cur_date' where id=$txt_hide") or die("");
					
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_course.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("course_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("course_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

