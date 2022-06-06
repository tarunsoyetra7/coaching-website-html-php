<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];

				
				
	if(isset($_REQUEST['txt_question_title']) && isset($_REQUEST['q_option_1']) && 
	isset($_REQUEST['q_option_2']) &&   isset($_REQUEST['q_option_3']) &&
	isset($_REQUEST['q_option_4'] )&& isset($_REQUEST['txt_question_title']) &&
	isset($_REQUEST['txt_priority'])&& isset($_REQUEST['answer_no']))
	{
	$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_question_title=str_replace("'","",$_REQUEST['txt_question_title']);
		
		$q_option_1=str_replace("'","",$_REQUEST['q_option_1']);
		$q_option_2=str_replace("'","",$_REQUEST['q_option_2']);
		$q_option_3=str_replace("'","",$_REQUEST['q_option_3']);
		$q_option_4=str_replace("'","",$_REQUEST['q_option_4']);
		$q_option_5=str_replace("'","",$_REQUEST['q_option_5']);
		$answer_no=str_replace("'","",$_REQUEST['answer_no']);
		$txt_priority=str_replace("'","",$_REQUEST['txt_priority']);		
			
		$que_solution=str_replace("'","",$_REQUEST['que_solution']);
		$txt_test_cat_hide=str_replace("'","",$_REQUEST['txt_test_cat_hide']);		
			
if($txt_hide=="" || $txt_hide==NULL){ 

	         $insQ=$db->query("insert into question_master
			 (que_title,optn_one,optn_two,optn_three,optn_four,optn_five,
			 ans_no,que_priority,que_solution,que_cat_id,created_by,created_on) 
			 values('$txt_question_title','$q_option_1','$q_option_2','$q_option_3','$q_option_4','$q_option_5',
			 '$answer_no',$txt_priority,'$que_solution','$txt_test_cat_hide',$login_id,NOW())") or die("");
				?>
			<script>
				alert("Sucessfully Added !...");
				window.location.replace("test_question_master.php");
			</script>
					
		<?php } else {
		$updateQ=$db->query("update  question_master
			  set que_title='$txt_question_title',optn_one='$q_option_1',
			  optn_two='$q_option_2',optn_three='$q_option_3',optn_four='$q_option_4',optn_five='$q_option_5',
			 ans_no='$answer_no',que_priority=$txt_priority,que_solution='$que_solution',que_cat_id='$txt_test_cat_hide',updated_by=$login_id,
			 updated_on=NOW() where id=$txt_hide") or die("");
		?>
		<script>
				alert("Sucessfully Update !...");
				window.location.replace("manage_test_question_master.php");
			</script>
		<?php
		
} ?>		
					
			
				<?php
					}
	
	
}

else
{
	header("location:../index.php");	
}
?>

