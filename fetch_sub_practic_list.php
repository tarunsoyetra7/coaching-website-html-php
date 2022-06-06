<?php include("root/db_connection.php");
	if(isset($_REQUEST['cur_id']) && isset($_REQUEST['cur_id'])){
		$cur_id=str_replace("'","",$_REQUEST['cur_id']);
		$fetch_q=$db->query("SELECT id, 
       q_cat_title ,q_cat_img       
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = 0  and id=$cur_id") or die("");
	   
	   $fetch_q_res=$fetch_q->fetch(PDO::FETCH_ASSOC);
	   
	   $cat_id=$fetch_q_res['id'];
	   ?>
	   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<img src="test_cat_image/<?php echo $fetch_q_res['id'].".".$fetch_q_res['q_cat_img']; ?>" style="float:left; margin-right:8px; width:50px;">
        <h5 style="font-size:17px; line-height:50px;" class="modal-title">
		
		<?php echo $fetch_q_res['q_cat_title']; ?></h5>
		<div style="clear:both;"></div>
      </div>
	   <?php
	    $childQ=$db->query("SELECT id, 
       q_cat_title        
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = $cat_id 
ORDER  BY q_cat_priority desc") or die("");
?>
<div class="modal-body">
<?php
	   while($childQ_res=$childQ->fetch(PDO::FETCH_ASSOC)){ 
	   ?>	   
	   <div class="col-lg-6" style="margin-bottom:15px;">
			<a href="practic_test_sub_page.php?id=<?php echo $childQ_res['id']; ?>" style="font-size:15px; color:#333; text-decoration:underline;"><i class="fa fa-chevron-right" style="font-size:12px; color:gray;"></i> 
			<?php echo $childQ_res['q_cat_title']; ?></a>
		</div>
		
	   <?php
	   }
	   ?>
	   
		<div style="clear:both;"></div>
</div>
	   <?php
	   
	}
	else{
		echo "Try Again !...";
	}
	?>