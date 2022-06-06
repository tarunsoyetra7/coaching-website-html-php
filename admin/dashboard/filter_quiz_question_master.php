<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['sel_val'])){
		$sel_val=str_replace("'","",$_REQUEST['sel_val']);
		
		
		$queQ=$db->query("select id,que_title,ans_no,que_cat_id,created_on,e_d_optn,
							flag,que_priority from quiz_question_master where find_in_set('$sel_val',que_cat_id) order by que_priority desc") or die(""); $i=0;
							if($queQ->rowCount()==0){ echo "No Record Found !...";
							}
							else{
								while($queQ_res=$queQ->fetch(PDO::FETCH_ASSOC)){ $i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									
									<td><input  type="checkbox" id="<?php echo $queQ_res['id']; ?>"></td>								
									
									<td><?php echo $queQ_res['que_title']; ?><br>
										
									</td>
									
								</tr>
							<?php } }
								
	}
	else{
		echo "Try Again !...";
	}	
}
else
{
	header("location:../index.php");	
}
?>
<script>
	$('input:checkbox').change(function(){
		if($(this).is(":checked")){
			$(this).addClass("chk_sel_q"); }
		else{
			$(this).removeClass("chk_sel_q");}
	});	
</script>