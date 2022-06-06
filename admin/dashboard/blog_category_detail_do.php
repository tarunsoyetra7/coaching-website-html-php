<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];



	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_short_description']) &&   isset($_REQUEST['txt_keyword']) && isset($_REQUEST['txt_menu_cat_hide'])){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_short_description=str_replace("'","",$_REQUEST['txt_short_description']);
		$txt_long_descp=str_replace("'","",$_REQUEST['txt_long_descp']);
		
		$txt_short_img=str_replace("'","",$_FILES['txt_short_img']['name']);
		$txt_short_img_ext=pathinfo($txt_short_img,PATHINFO_EXTENSION);
		
		$txtEnableDisable=str_replace("'","",$_REQUEST['txtEnableDisable']);
		
		$txt_keyword=str_replace("'","",$_REQUEST['txt_keyword']);
		$txt_description=str_replace("'","",$_REQUEST['txt_description']);		
		$txt_menu_cat_hide=str_replace("'","",$_REQUEST['txt_menu_cat_hide']);		
		
		$cur_date=date("Y-m-d");
			if($txt_short_img_ext=="jpg" || $txt_short_img_ext=="JPG" 
				|| $txt_short_img_ext=="PNG" || $txt_short_img_ext=="png" || $txt_short_img_ext=="JPEG" ||
				$txt_short_img_ext=="jpeg" ||  $txt_short_img_ext=="" || $txt_short_img_ext==NULL){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into blog_category_detail(b_title,b_cat_id,b_s_descp,b_l_descp,b_key,
					b_descp,b_short_img,created_by,created_on,e_d_optn)
					values('$txt_title','$txt_menu_cat_hide','$txt_short_description','$txt_long_descp','$txt_keyword',
					'$txt_description','$txt_short_img_ext',$login_id,NOW(),'$txtEnableDisable')") or die("");
					
					$lastID=$db->lastInsertId();
					
					
					$short_img_name=$lastID.".".$txt_short_img_ext;
					move_uploaded_file($_FILES['txt_short_img']['tmp_name'],"../../blog_detail_short_img/".$short_img_name);
					
					
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("blog_category_detail.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
					
					
					if($txt_short_img_ext=="" || $txt_short_img_ext==NULL){
						$short_img_condition="";
					}
					else{
						$short_img_condition=",b_short_img='$txt_short_img_ext'";
						$lastID=$txt_hide;
					$short_img_name=$lastID.".".$txt_short_img_ext;
					move_uploaded_file($_FILES['txt_short_img']['tmp_name'],"../../blog_detail_short_img/".$short_img_name);
					}
					
					
					
					
					$updateQ=$db->query("update blog_category_detail set b_title='$txt_title',b_cat_id='$txt_menu_cat_hide',
					b_s_descp='$txt_short_description'
					
					$short_img_condition
					
					,b_l_descp='$txt_long_descp',b_key='$txt_keyword',
					b_descp='$txt_description',updated_by=$login_id,updated_on=NOW(),e_d_optn='$txtEnableDisable' where id=$txt_hide") or die("");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_blog_category_detail.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("blog_category_detail.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("blog_category_detail.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

