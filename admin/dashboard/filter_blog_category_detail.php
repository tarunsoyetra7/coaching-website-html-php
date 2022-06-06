<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['sel_val'])){
		$sel_val=str_replace("'","",$_REQUEST['sel_val']);		
		$query=$db->query("select id,b_title,b_short_img,created_on,e_d_optn,flag,b_cat_id from
							blog_category_detail where find_in_set('$sel_val',b_cat_id) order by id desc") or die("");
		if($query->rowCount()==0){ 
			echo "No Record Found !..."; 
		}
		else {
			$i=0;
				while($result=$query->fetch(PDO::FETCH_ASSOC)){ $i++;
				?>
			<tr>
				<td><?php echo $i;  ?></td>
				<td>
				<img src="../../blog_detail_short_img/<?php echo $result['id'].".".$result['b_short_img']; ?>" style="width:50px; height:50px; float:left; margin-right:7px; margin-bottom:7px; ">
				<?php echo $result['b_title']; ?>
				<br>
					Created On : <?php echo $result['created_on']; ?>
								</td>
								<td>
								<?php $cat_id=$result['b_cat_id']; 
								$catQ=$db->query("select id,group_concat(b_cat_title) as b_cat_title from blog_category_master where
								find_in_set(id,'$cat_id')") or die("");
								$catQ_res=$catQ->fetch(PDO::FETCH_ASSOC);
								echo $catQ_res['b_cat_title'];
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
		
<?php } ?>


</td>
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
 
	  
$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_blog_category_detail_master.php",
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
			url:"restore_blog_category_detail_master.php",
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
			url:"enable_blog_category_detail_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	
	
		$(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("blog_category_detail.php?id="+cur_id);
	});
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_blog_category_detail_master.php",
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