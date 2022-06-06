<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['sel_val'])){
		$sel_val=str_replace("'","",$_REQUEST['sel_val']);
		
		
		$queQ=$db->query("select id,que_title,ans_no,que_cat_id,created_on,e_d_optn,
							flag,que_priority from question_master where find_in_set('$sel_val',que_cat_id) order by que_priority desc") or die(""); $i=0;
							if($queQ->rowCount()==0){ echo "No Record Found !...";
							}
							else{
								while($queQ_res=$queQ->fetch(PDO::FETCH_ASSOC)){ $i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $queQ_res['que_title']; ?><br>
										<strong>Created On : </strong><?php echo $queQ_res['created_on']; ?>
									</td>
									<td><?php echo $queQ_res['ans_no']; ?></td>
									<td><?php $testCat=$queQ_res['que_cat_id'];
									
									
										$queCatQ=$db->query("select group_concat(q_cat_title)
										as que_title,id from online_test_category where find_in_set(id,'$testCat')") or die("");
										$queCatQ_res=$queCatQ->fetch(PDO::FETCH_ASSOC);
										echo $queCatQ_res['que_title'];
									?></td>
									<td><?php echo $queQ_res['que_priority']; ?></td>
									<td>

								<button id="<?php echo $queQ_res['id']; ?>" class="btn btn-sm btn-info btn_edit">Edit</button>			
						
									<?php if($queQ_res['e_d_optn']=='true'){
?>
<span class="enable_button" id="button_<?php echo $queQ_res['id']; ?>">
	<button class="btn btn-sm btn-success" onClick="btn_disable(<?php echo $queQ_res['id']; ?>);" id="mbtn_<?php echo $queQ_res['id']; ?>">Enable</button>
</span>
<?php	} else {
?>
<span class="disable_button" id="button_<?php echo $queQ_res['id']; ?>">
	<button class="btn btn-sm btn-danger"  onClick="enable_btn(<?php echo $queQ_res['id']; ?>)"  id="mbtn_<?php echo $queQ_res['id']; ?>">Disable</button>
</span>
<?php
	} ?>
<img src="loading2.gif" style="width:30px; height:30px;" class="pull-right loader_image" id="lo_<?php echo $queQ_res['id']; ?>">



							
							
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
  
	 $(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("test_question_master.php?id="+cur_id);
	});  
	  


function btn_disable(id){
		var cur_id=id;
		$("#lo_"+cur_id).css("visibility","visible");
		$("#mbtn_"+cur_id).prop("disabled",true);
		$.ajax({
			type:"POST",
			url:"disable_test_question_master",
			data:{cur_id:cur_id},
			success:function(r_data){
				//alert(r_data);
				//location.reload();
				var on_click="onclick='enable_btn("+cur_id+");'";
				var btndata="<button class='btn btn-sm btn-danger' "+on_click+" id='mbtn_"+cur_id+"'>Disable</button>";
				$("#button_"+cur_id).html(btndata);
				$("#mbtn_"+cur_id).prop("disabled",false);
				$("#lo_"+cur_id).css("visibility","hidden");
			},error:function(err){
			location.reload();
			}
		});
		
	}





function enable_btn(id){
		var cur_id=id;
		
		$("#lo_"+cur_id).css("visibility","visible");		
		
		$("#mbtn_"+cur_id).prop("disabled",true);
		
		$.ajax({
			type:"POST",
			url:"enable_test_question_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				//alert(r_data);
				//location.reload();
				var on_click="onclick='btn_disable("+cur_id+");'";
				var btndata="<button class='btn btn-sm btn-success' "+on_click+"  id='mbtn_"+cur_id+"'>Enable</button>";
				$("#button_"+cur_id).html(btndata);
				$("#mbtn_"+cur_id).prop("disabled",false);
				$("#lo_"+cur_id).css("visibility","hidden");
			},error:function(err){
			location.reload();
			}
		});
	}
	



</script>