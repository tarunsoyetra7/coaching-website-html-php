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

		$txt_course=$_REQUEST['txt_course'];		
		
		$cur_date=date("Y-m-d");
			if($txt_doc_ext=="jpg" || $txt_doc_ext=="doc" 
				|| $txt_doc_ext=="txt" || $txt_doc_ext=="xls" || $txt_doc_ext=="docx" 
				|| $txt_doc_ext=="png" || $txt_doc_ext=="pdf" || $txt_doc_ext=="jpeg" || $txt_doc_ext=="zip" || 
				$txt_doc_ext=="ZIP" || $txt_doc_ext=="rar" || $txt_doc_ext=="RAR" ||  
				$txt_doc_ext==""|| $txt_doc_ext==NULL || $txt_doc_ext=="c" || $txt_doc_ext=="cpp"){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into download_master(dw_title,dw_file,dw_link,created_by,created_on,dw_c_id )  values('$txt_title','$txt_doc_ext','$txt_url',$login_id,'$cur_date',$txt_course)") or die("");
					
					
					$lastID=$db->lastInsertId();
					
					
					$short_img_name=$lastID.".".$txt_doc_ext;
					move_uploaded_file($_FILES['txt_doc']['tmp_name'],"../../download_master_doc/".$short_img_name);
					
					
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("download_master.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
					
					
					if($txt_doc=="" || $txt_doc==NULL){
						$short_img_condition="";
					}
					else{
						$short_img_condition=",dw_file='$txt_doc_ext'";
						$lastID=$txt_hide;
					$short_img_name=$lastID.".".$txt_doc_ext;
					move_uploaded_file($_FILES['txt_doc']['tmp_name'],"../../download_master_doc/".$short_img_name);
					}
					
					
					
					
					$updateQ=$db->query("update download_master set dw_title='$txt_title',dw_link='$txt_url'					
					$short_img_condition
					
					,updated_by=$login_id,updated_on=NOW(),dw_c_id=$txt_course where id=$txt_hide") or die("");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_download_master.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("download_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("download_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

