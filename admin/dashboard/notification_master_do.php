<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];



	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_btn_url']) ){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		
		$txt_long_descp=str_replace("'","",$_REQUEST['txt_long_descp']);
		
		$txt_btn_url=str_replace("'","",$_REQUEST['txt_btn_url']);
		
		
		
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into notification_master(noti_title,noti_detail ,noti_url ,created_by ,created_on )
					values('$txt_title','$txt_long_descp','$txt_btn_url',$login_id,NOW())") or die("");
					

					
					
					?>
						<script>
				alert("Sucessfully Added !...");
				window.location.replace("notification_master.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
					
					
					
					$updateQ=$db->query("update notification_master set
						noti_title='$txt_title'  ,noti_url ='$txt_btn_url',
						noti_detail='$txt_long_descp'
					
					
					
					,updated_by=$login_id,updated_on=NOW() where id=$txt_hide") or die("");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
			window.location.replace("notification_master.php");
			</script>
					<?php
				}	
					

	}
	else{
		?>
			<script>
				alert("Try Again !...");
				window.location.replace("notification_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

