<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['sel_val'])){
		$sel_val=str_replace("'","",$_REQUEST['sel_val']);
		$query=$db->query("select id,n_title,n_cat_id,created_on,
							e_d_optn,flag from news_article_detail where FIND_IN_SET('$sel_val',n_cat_id) order by id desc") or die("");
			if($query->rowCount()==0){ echo "No Record Found !..."; } else {
 $i=0;
while($result=$query->fetch(PDO::FETCH_ASSOC)){			$i++;				?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['n_title']; ?><br>
								<strong>Created On : </strong><?php echo $result['created_on']; ?>
								</td>
								<td>
								<?php $cat_id=$result['n_cat_id'];
								
										$catQ=$db->query("select group_concat(cat_title) as cat_title 
										from news_article_category_master where find_in_set(id,'$cat_id')") or die("");
										$catQ_res=$catQ->fetch(PDO::FETCH_ASSOC);
										echo $catQ_res['cat_title'];
								?>
								</td>
								
								<td>
								<?php if($result['flag']=='true'){ ?>
								
									<button id="<?php echo $result['id']; ?>" class="btn btn-sm btn-info btn_edit">Edit</button>
						
						
									<?php if($result['e_d_optn']=='true'){

?>
<button class="btn btn-sm btn-success btn_disable" id="<?php echo $result['id']; ?>">Enable</button>
<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $result['id']; ?>">Delete</button>
<?php									} else {
?>
<button class="btn btn-sm btn-danger enable_btn" id="<?php echo $result['id']; ?>">Disable</button>

<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $result['id']; ?>">Delete</button>


<?php
	} ?>
									
<?php } else { ?>								
									
		<button class="btn btn-sm btn-default btn_restore" id="<?php echo $result['id']; ?>">Restore</button>
		
<?php } ?></td>
							</tr>
			<?php }  } 
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
		window.location.replace("news_article_detail_master.php?id="+cur_id);
	});
	
	
$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_news_article_detail_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});


$(".btn_restore").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"restore_news_article_detail_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	$(".enable_btn").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"enable_news_article_detail_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_news_article_detail_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	</script>