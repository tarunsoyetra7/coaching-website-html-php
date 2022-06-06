<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['txt_menu_title']) && isset($_REQUEST['txt_priority']) &&   isset($_REQUEST['txt_keyword']) && isset($_REQUEST['txt_description'])){
		$txt_menu_title=str_replace("'","",$_REQUEST['txt_menu_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_sel_parent=str_replace("'","",$_REQUEST['txt_sel_parent']);
		$txt_image=str_replace("'","",$_FILES['txt_image']['name']);
		$img_ext=pathinfo($txt_image,PATHINFO_EXTENSION);
		$txt_short_description=str_replace("'","",$_REQUEST['txt_short_description']);
		$txt_keyword=str_replace("'","",$_REQUEST['txt_keyword']);
		$txt_description=str_replace("'","",$_REQUEST['txt_description']);		
		$txt_priority=str_replace("'","",$_REQUEST['txt_priority']);		
		
		
		
		$cur_date=date("Y-m-d");
			if($img_ext=="" || $img_ext==NULL || $img_ext=="jpg" || $img_ext=="JPG" || $img_ext=="png" || 
				$img_ext=="PNG" || $img_ext=="jpeg" || $img_ext=="JPEG"){
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into vocab_express_master(m_title,m_parent_id,m_keyword,m_descp,
					m_img,m_short_descp,m_priority,created_by,created_on) 
					
					values('$txt_menu_title',$txt_sel_parent,'$txt_keyword','$txt_description',
					'$img_ext','$txt_short_description',$txt_priority,$login_id,'$cur_date')") or die("");
					
					$lastID=$db->lastInsertId();
					$img_name=$lastID.".".$img_ext;
					move_uploaded_file($_FILES['txt_image']['tmp_name'],"../../vocab_express_image/".$img_name);
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("vocab_express_master.php");
			</script>
					<?php
				}
				else{
					
					if($img_ext=="" || $img_ext==NULL){
						$img_condition="";
					}
					else{
						$img_condition=",m_img='$img_ext'";
						$lastID=$txt_hide;
					$img_name=$lastID.".".$img_ext;
					move_uploaded_file($_FILES['txt_image']['tmp_name'],"../../vocab_express_image/".$img_name);
					}
					
					
					
					$updateQ=$db->query("update vocab_express_master set m_title='$txt_menu_title',m_parent_id=$txt_sel_parent,
					m_keyword='$txt_keyword',m_descp='$txt_description'
					
					$img_condition
					
					,m_short_descp='$txt_short_description',m_priority=$txt_priority,
					
					
					updated_by=$login_id,updated_on='$cur_date' where id=$txt_hide") or die("");
					
					
					?>
					<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_vocab_master.php");
			</script>
					<?php
				}	
					
			}
			else{
				?>
					<script>
				alert("Invalid File Format !...");
				window.location.replace("vocab_express_master.php");
			</script>
			
				<?php
			}
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("vocab_express_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

