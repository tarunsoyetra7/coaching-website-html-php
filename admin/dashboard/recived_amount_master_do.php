<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	
	if(isset($_REQUEST['txt_frm_emp_id']) && isset($_REQUEST['txt_sel_date']) 
		&& isset($_REQUEST['txt_amnt']) && isset($_REQUEST['txt_remark'])){
			
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_frm_emp_id=str_replace("'","",$_REQUEST['txt_frm_emp_id']);
		$txt_sel_date=str_replace("'","",$_REQUEST['txt_sel_date']);
		$txt_amnt=str_replace("'","",$_REQUEST['txt_amnt']);
		$txt_remark	=str_replace("'","",$_REQUEST['txt_remark']);

		
		if($txt_hide=="" || $txt_hide==null){
		$insQ=$db->query("insert into recipt_master(frm_emp_id ,send_date ,amount ,
		remark ,created_on ,created_by) values($txt_frm_emp_id,'$txt_sel_date',$txt_amnt,'$txt_remark',
		NOW(),$login_id)") or die("");
			
		
		?>
			<script>
				alert("Sucessfully Saved !..");
				window.location.replace("recived_amount_master.php");
			</script>
		<?php
		
		}
		else{
			$insQ=$db->query("update recipt_master set frm_emp_id =$txt_frm_emp_id,
			send_date ='$txt_sel_date',amount= $txt_amnt,
			remark ='$txt_remark',updated_by=$login_id,updated_on=NOW() where id=$txt_hide") or die("");
			?>
				<script>
					alert("Sucessfully Updated !..");
					window.location.replace("employee_transcation_history.php");
				</script>
			<?php
		}
		
	}
	else{
	}		
}
else
{
	header("location:../index.php");	
}
?>