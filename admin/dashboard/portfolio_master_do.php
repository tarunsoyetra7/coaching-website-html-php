<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];



	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_url']) ){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_url=str_replace("'","",$_REQUEST['txt_url']);
		
		
		$txt_doc=str_replace("'","",$_FILES['txt_doc']['name']);
		$txt_doc_ext=pathinfo($txt_doc,PATHINFO_EXTENSION);
		
				
		
		$cur_date=date("Y-m-d");
			if($txt_doc_ext=="jpg" 	|| $txt_doc_ext=="png"|| $txt_doc_ext=="pdf" || $txt_doc_ext=="jpeg" || $txt_doc_ext==""|| $txt_doc_ext==NULL){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into portfolio_master(pf_title,pf_file,pf_link,created_by,created_on)  values('$txt_title','$txt_doc_ext','$txt_url',$login_id,'$cur_date')") or die("");
					
					
					$lastID=$db->lastInsertId();
					
					
					$short_img_name=$lastID.".".$txt_doc_ext;
					move_uploaded_file($_FILES['txt_doc']['tmp_name'],"../../portfolio_master_img/".$short_img_name);
					
					
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("portfolio_master.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
					
					
					if($txt_doc=="" || $txt_doc==NULL){
						$short_img_condition="";
					}
					else{
						$short_img_condition=",pf_file='$txt_doc_ext'";
						$lastID=$txt_hide;
					$short_img_name=$lastID.".".$txt_doc_ext;
					move_uploaded_file($_FILES['txt_doc']['tmp_name'],"../../portfolio_master_img/".$short_img_name);
					}
					
					
					
					
					$updateQ=$db->query("update portfolio_master set pf_title='$txt_title',pf_link='$txt_url'					
					$short_img_condition
					
					,updated_by=$login_id,updated_on=NOW() where id=$txt_hide") or die("");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_portfolio_master.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("portfolio_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("portfolio_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

