<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['txt_q_title']) && isset($_REQUEST['txtCatQue_id']) &&   
	isset($_REQUEST['txtSelTotalQue'])  &&   isset($_REQUEST['txt_total_time']) &&   
	isset($_REQUEST['txt_q_priority']) ){ 
		
		$txt_q_title=str_replace("'","",$_REQUEST['txt_q_title']);
		$txtHide=str_replace("'","",$_REQUEST['txtHide']);
		$txtCatQue_id=str_replace("'","",$_REQUEST['txtCatQue_id']);
		$txtSelTotalQue=str_replace("'","",$_REQUEST['txtSelTotalQue']);
		$txt_total_time=str_replace("'","",$_REQUEST['txt_total_time']);
		$txt_q_priority=str_replace("'","",$_REQUEST['txt_q_priority']);
		
		
		
		if($txtHide=="" || $txtHide==NULL){
					
		$insQ=$db->query("INSERT INTO quiz_maste(q_title,q_cat_id_que_id,
			q_total_que,q_totl_time,q_priority,created_by,created_on) 
			VALUES('$txt_q_title','$txtCatQue_id',
			$txtSelTotalQue,$txt_total_time,$txt_q_priority,$login_id,NOW())") or die("");
			
			?>
			<script>
				alert("Sucessfully Saved !...");
				window.location.replace("quiz_master.php");
			</script>
			<?php
			
		}
		else{
			
			
			$insQ=$db->query("update quiz_maste set q_title='$txt_q_title',q_cat_id_que_id='$txtCatQue_id',
			q_total_que='$txtSelTotalQue',q_totl_time=$txt_total_time,q_priority=$txt_q_priority,updated_by=$login_id,
			updated_on=NOW() where id=$txtHide") or die("");
			
			?>
			<script>
				alert("Sucessfully Updated !...");
				window.location.replace("manage_quiz_master.php");
			</script>
			<?php
			
			
		}
	}
	else{
		?>
		<script>
			alert("Try Again !...");
			window.location.replace("quiz_master.php");
		</script>
		<?php
	}		
}
else
{
	header("location:../index.php");	
}
?>