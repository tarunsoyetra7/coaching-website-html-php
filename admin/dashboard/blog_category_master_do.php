<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	
	if(isset($_REQUEST['txt_b_cat_title']) && isset($_REQUEST['txt_priority']) &&   isset($_REQUEST['txt_keyword']) && isset($_REQUEST['txt_description'])){
		$txt_b_cat_title=str_replace("'","",$_REQUEST['txt_b_cat_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txtEnableDisable=str_replace("'","",$_REQUEST['txtEnableDisable']);
		$txt_keyword=str_replace("'","",$_REQUEST['txt_keyword']);
		$txt_description=str_replace("'","",$_REQUEST['txt_description']);		
		$txt_priority=str_replace("'","",$_REQUEST['txt_priority']);		
		
			
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into blog_category_master(b_cat_title,b_cat_priority,b_cat_key,b_cat_descp,
					e_d_optn,created_by,created_on) 
					
					values('$txt_b_cat_title',$txt_priority,'$txt_keyword','$txt_description',
					'$txtEnableDisable',$login_id,NOW())") or die("");
								
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("blog_category_master.php");
			</script>
					<?php
				}
				else{
					
					
					$updateQ=$db->query("update blog_category_master set b_cat_title='$txt_b_cat_title',b_cat_priority=$txt_priority,
					b_cat_key='$txt_keyword',b_cat_descp='$txt_description'
					
					,e_d_optn='$txtEnableDisable',
					updated_by=$login_id,updated_on=NOW() where id=$txt_hide") or die("");
					
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_blog_category_master.php");
			</script>
					<?php
				}	
					
		
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("blog_category_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

