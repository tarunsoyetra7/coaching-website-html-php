<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['cur_id'])){
		$cur_id=str_replace("'","",$_REQUEST['cur_id']);
				
	$rootQ=$db->query("SELECT  id,q_title,q_cat_id_que_id FROM  
	quiz_maste WHERE id=$cur_id") or die("");
	
	
	while($rootQ_res=$rootQ->fetch(PDO::FETCH_ASSOC)){
	
$q_cat_id_que_id=$rootQ_res['q_cat_id_que_id'];

$QcatId=explode("|",$q_cat_id_que_id);
//echo count($QcatId);
for($i=0; $i<count($QcatId); $i++){
	 $QcatId_new=explode("-",$QcatId[$i]);
	$questionCatId=$QcatId_new[0];
	$questionId=$QcatId_new[1];
	
	
	$r_q=$db->query("SELECT id,q_cat_title FROM online_test_category WHERE id=$questionCatId") or die("");
	while($r_q_res=$r_q->fetch(PDO::FETCH_ASSOC)){
	?>
	
	<div class="r_q_cls">
	<input type="hidden" id="txtRTCat_id"  name="txtRTCat_id">
	<h4><?php echo $r_q_res['q_cat_title']; ?></h4>
	
	
			<table class="table table-responsive table-striped table-bordered table-hover table-condensed">
				<thead style="background:#333; color:#fff;">
					<tr>
						<th>S No</th>
						
						<th>Question</th>						
					</tr>
				</thead>				
				<tbody id="txtRQ_id">	
<?php $q_q=$db->query("SELECT id,que_title FROM question_master WHERE FIND_IN_SET(id,'$questionId') 
	and flag='true' AND e_d_optn='true'") or die(""); $j=0;
		while($q_q_res=$q_q->fetch(PDO::FETCH_ASSOC)){ $j++;
	?>				
					<tr>
						<td><?php echo $j; ?></td>
						
						<td><?php echo $q_q_res['que_title']; ?></td>					
					</tr>
						<?php } ?>	
				</tbody>
			</table>
			<hr>
</div>	
	<?php } ?>		
	<?php
}


?>

	<?php } ?>
<?php		
								
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