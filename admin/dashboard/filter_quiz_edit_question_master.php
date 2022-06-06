<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	
	
	if(isset($_REQUEST['cat_id'])  &&  isset($_REQUEST['que_id'])){
		$cat_id=str_replace("'","",$_REQUEST['cat_id']);
		$que_id=str_replace("'","",$_REQUEST['que_id']);	
$catQ=$db->query("SELECT
node.id,
    node.q_cat_parent,
    CONCAT(IFNULL(up3.q_cat_title, ''), IFNULL(CONCAT(up2.q_cat_title, ' --> '), ''), 
	IFNULL(CONCAT(up1.q_cat_title, ' --> '), ''), node.q_cat_title) AS q_cat_title
FROM online_test_category AS node
LEFT OUTER JOIN online_test_category AS up1
ON up1.id = node.q_cat_parent
LEFT OUTER JOIN online_test_category AS up2
ON up2.id = up1.q_cat_parent
LEFT OUTER JOIN online_test_category AS up3
ON up3.id = up2.q_cat_parent
WHERE node.flag = 'true' AND node.id=$cat_id
ORDER BY node.id DESC ") or die("");
$catQ_res=$catQ->fetch(PDO::FETCH_ASSOC);
		
		?>
<!---start--->
<h4 align="center">
			<label id="txt_edit_cat_name"><?php  echo $catQ_res['q_cat_title'];  ?> </label>
			<input type="hidden" id="txt_edit_hidden_cat_id" value="<?php echo $cat_id; ?>">
		</h4>

<div class="col-lg-12">

    <div style="height:400px; overflow:auto;">

      
        <table class="table table-responsive table-striped table-bordered table-hover table-condensed">
            <thead style="background:#333; color:#fff;">
                <tr>
                    <th>S No</th>
                    <th>Option</th>
                    <th>Question</th>
                </tr>
            </thead>

            <tbody id="edit_question_list">
			<?php

			$queQ=$db->query("SELECT id, 
       que_title, 
       ans_no, 
       que_cat_id, 
       created_on, 
       e_d_optn, 
       flag, 
       que_priority 
FROM   quiz_question_master 
WHERE  FIND_IN_SET('$cat_id', que_cat_id) AND FIND_IN_SET(id,'$que_id')
ORDER  BY que_priority DESC ") or die(""); $i=0;
$totalCount=$queQ->rowCount();
		while($queQ_res=$queQ->fetch(PDO::FETCH_ASSOC)){ $i++;
					?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
					
						<input checked type="checkbox" id="<?php echo $queQ_res['id']; ?>" class="chk_e_sel_q">
					
						
					
					</td>
                    <td>
					<?php  echo $queQ_res['que_title']; ?>
					</td>
                </tr>
		<?php } ?>
		
		
		
		<?php

			$queQ=$db->query("SELECT id, 
       que_title, 
       ans_no, 
       que_cat_id, 
       created_on, 
       e_d_optn, 
       flag, 
       que_priority 
FROM   quiz_question_master 
WHERE  FIND_IN_SET('$cat_id', que_cat_id) AND !FIND_IN_SET(id,'$que_id')
ORDER  BY que_priority DESC ") or die(""); $i=$totalCount;

		while($queQ_res=$queQ->fetch(PDO::FETCH_ASSOC)){ $i++;
					?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
					
						
					
						<input  type="checkbox" id="<?php echo $queQ_res['id']; ?>" >
					
					</td>
                    <td>
					<?php  echo $queQ_res['que_title']; ?>
					</td>
                </tr>
		<?php } ?>
		
		
            </tbody>
        </table>
    </div>
</div>

<div style="clear:both;"></div>


<!---end--->		
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
			$(this).addClass("chk_e_sel_q"); }
		else{
			$(this).removeClass("chk_e_sel_q");}
	});	
</script>