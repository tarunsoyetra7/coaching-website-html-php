<?php
if(isset($_COOKIE['login']))
{
	


	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['txt_test_title']) && isset($_REQUEST['txt_priority']) &&   isset($_REQUEST['txt_keyword'])  &&   isset($_REQUEST['txt_seo_description'])){
		$txt_test_title=str_replace("'","",$_REQUEST['txt_test_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_sel_parent=str_replace("'","",$_REQUEST['txt_sel_parent']);
		$txt_image=str_replace("'","",$_FILES['txt_image']['name']);
		$img_ext=pathinfo($txt_image,PATHINFO_EXTENSION);
		
		$txt_keyword=str_replace("'","",$_REQUEST['txt_keyword']);
		$txt_description=str_replace("'","",$_REQUEST['txt_seo_description']);		
		$txt_priority=str_replace("'","",$_REQUEST['txt_priority']);		
		
		$txt_short_descp=str_replace("'","",$_REQUEST['txt_short_descp']);		;
		
		$cur_date=date("Y-m-d");
			if($img_ext=="" || $img_ext==NULL || $img_ext=="jpg" || $img_ext=="JPG" || $img_ext=="png" || 
				$img_ext=="PNG" || $img_ext=="jpeg" || $img_ext=="JPEG"){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into online_test_category(q_cat_title ,q_cat_parent ,q_cat_img ,q_cat_keyword ,
					q_cat_descp ,q_cat_priority ,q_cat_short_descp ,created_by ,created_on) 
					
					values('$txt_test_title',$txt_sel_parent,'$img_ext','$txt_keyword',
					'$txt_description',$txt_priority,'$txt_short_descp',$login_id,'$cur_date')") or die("");
					
					$lastID=$db->lastInsertId();
					$img_name=$lastID.".".$img_ext;
					move_uploaded_file($_FILES['txt_image']['tmp_name'],"../../test_cat_image/".$img_name);
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("test_category_master.php");
			</script>
					<?php
				}
				else{
					
					if($img_ext=="" || $img_ext==NULL){
						$img_condition="";
					}
					else{
						$img_condition=",q_cat_img='$img_ext'";
						$lastID=$txt_hide;
					$img_name=$lastID.".".$img_ext;
					move_uploaded_file($_FILES['txt_image']['tmp_name'],"../../test_cat_image/".$img_name);
					}
					
					
					$updateQ=$db->query("update online_test_category set q_cat_title='$txt_test_title' ,q_cat_parent=$txt_sel_parent 
					
					$img_condition
					
					,q_cat_keyword='$txt_keyword'
					,q_cat_descp ='$txt_description',q_cat_priority=$txt_priority ,
					q_cat_short_descp='$txt_short_descp' ,updated_by=$login_id ,updated_on='$cur_date' where id=$txt_hide") or die("");
					
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_test_category_master.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("test_category_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("test_category_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

