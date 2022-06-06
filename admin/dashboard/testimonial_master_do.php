<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];



	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_testimonial'])){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_testimonial=str_replace("'","",$_REQUEST['txt_testimonial']);
		
		
		$txt_short_img=str_replace("'","",$_FILES['txt_img']['name']);
		$txt_short_img_ext=pathinfo($txt_short_img,PATHINFO_EXTENSION);
		
		
		$txt_emailadd=str_replace("'","",$_REQUEST['txt_emailadd']);
				
		
		$cur_date=date("Y-m-d");
			if($txt_short_img_ext=="jpg" || $txt_short_img_ext=="JPG" 
				|| $txt_short_img_ext=="PNG" || $txt_short_img_ext=="png" || $txt_short_img_ext=="JPEG" ||
				$txt_short_img_ext=="jpeg" ||  $txt_short_img_ext=="" || $txt_short_img_ext==NULL){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into testimonial_master(t_client_name,t_img,t_testimonial,created_by,created_on,t_email)
					values('$txt_title','$txt_short_img_ext','$txt_testimonial',$login_id,NOW(),'$txt_emailadd')") or die("");
					
					$lastID=$db->lastInsertId();
					
					
					$short_img_name=$lastID.".".$txt_short_img_ext;
					move_uploaded_file($_FILES['txt_img']['tmp_name'],"../../testimonial_img/".$short_img_name);
					
					
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("testimonial_master.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
					
					
					if($txt_short_img_ext=="" || $txt_short_img_ext==NULL){
						$short_img_condition="";
					}
					else{
						$short_img_condition=",t_img='$txt_short_img_ext'";
						$lastID=$txt_hide;
					$short_img_name=$lastID.".".$txt_short_img_ext;
					move_uploaded_file($_FILES['txt_img']['tmp_name'],"../../testimonial_img/".$short_img_name);
					}
					
					
					
					
					$updateQ=$db->query("update testimonial_master set t_client_name='$txt_title',t_testimonial='$txt_testimonial'
					$short_img_condition
					
					,updated_by=$login_id,updated_on=NOW(),t_email='$txt_emailadd' where id=$txt_hide") or die("dfgh");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
			window.location.replace("manage_testimonial_master.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("testimonial_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("testimonial_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

