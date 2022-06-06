<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];



	if(isset($_REQUEST['txt_title']) && isset($_REQUEST['txt_description']) ){
		$txt_title=str_replace("'","",$_REQUEST['txt_title']);
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_description=str_replace("'","",$_REQUEST['txt_description']);
		
		
		$cur_date=date("Y-m-d");
			
					
				if($txt_hide=="" || $txt_hide==NULL){
					
					
					$insQ=$db->query("insert into latest_news_master(news_title,news_descp,created_by,created_on)
					values('$txt_title','$txt_description',$login_id,NOW())") or die("");
					
					
					
					
					?>
						<script>
				alert("Sucessfully Added !...");
			window.location.replace("latest_news_master.php");
			</script>
					<?php
				}
				else{
					//echo $txt_menu_cat_hide;
				
					$updateQ=$db->query("update latest_news_master set news_title='$txt_title',
					news_descp='$txt_description',updated_by=$login_id,updated_on=NOW() where id=$txt_hide") or die("");			
					
					?>
					<script>
				alert("Sucessfully Updated !...");
			window.location.replace("manage_latest_news.php");
			</script>
					<?php
				}	
		
		
	}
	else{
		?>
			<script>
				alert("Try Again !...");
			window.location.replace("latest_news_master.php");
			</script>
				<?php
	}
	
		
}
else
{
	header("location:../index.php");	
}
?>

