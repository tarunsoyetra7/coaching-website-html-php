<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];



	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_a_priority']) && isset($_REQUEST['txt_menu_cat_hide'])	&& isset($_REQUEST['txt_a_url']) ){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_a_priority=str_replace("'","",$_REQUEST['txt_a_priority']);
		$txt_a_url=str_replace("'","",$_REQUEST['txt_a_url']);		
		$txt_menu_cat_hide=str_replace("'","",$_REQUEST['txt_menu_cat_hide']);		
			
		$txt_short_img=str_replace("'","",$_FILES['txt_a_img']['name']);
		$txt_short_img_ext=pathinfo($txt_short_img,PATHINFO_EXTENSION);		
						
			if($txt_short_img_ext=="jpg" || $txt_short_img_ext=="JPG" 
				|| $txt_short_img_ext=="PNG" || $txt_short_img_ext=="png" || $txt_short_img_ext=="JPEG" ||
				$txt_short_img_ext=="jpeg" ||  $txt_short_img_ext=="" || $txt_short_img_ext==NULL){					
				if($txt_hide=="" || $txt_hide==NULL){
					$insQ=$db->query("insert into ads_master(a_title ,a_img,a_url ,a_priority ,a_sel_loc,created_by ,created_on )
					values('$txt_title','$txt_short_img_ext','$txt_a_url','$txt_a_priority','$txt_menu_cat_hide',$login_id,NOW())") or die("");					
					$lastID=$db->lastInsertId();			
					
					$short_img_name=$lastID.".".$txt_short_img_ext;
					move_uploaded_file($_FILES['txt_a_img']['tmp_name'],"../../ads_img/".$short_img_name);
					
					
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("ads_master.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
					
					
					if($txt_short_img_ext=="" || $txt_short_img_ext==NULL){
						$short_img_condition="";
					}
					else{
						$short_img_condition=",a_img='$txt_short_img_ext'";
						$lastID=$txt_hide;
					$short_img_name=$lastID.".".$txt_short_img_ext;
					move_uploaded_file($_FILES['txt_a_img']['tmp_name'],"../../ads_img/".$short_img_name);
					}
					
					$updateQ=$db->query("update ads_master set 
					a_title='$txt_title' ,a_url='$txt_a_url' ,a_priority='$txt_a_priority' ,a_sel_loc='$txt_menu_cat_hide' 
					
					$short_img_condition
					
					,updated_by=$login_id,updated_on=NOW() where id=$txt_hide") or die("");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
			window.location.replace("manage_ads_master.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("ads_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("ads_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

