<?php
	if(isset($_COOKIE['login'])){

		$login_id= $_COOKIE['login'];
		require("../../root/db_connection.php");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
       <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
     <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
<style>
.testClsClass{
	float:left; padding:5px; background:#ccc; margin:3px;
}
</style>
	 <style>
            li {
                list-style: none;
            }
        </style>
        <style>
            .list_category_list {
                padding-left: 15px;
            }
            
            .list_category_list li {
                line-height: 25px;
            }
        </style>
		
		
<style>
#filter_loader{
	display:none;
}

.edit_span{
	cursor:pointer; color:green;
}


</style>
        <div id="wrapper">
            <?php  include("header.php");  ?>
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 align="center"><strong>Quiz Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                   
                                                <li class="active">
                                        <a href="quiz_master.php"><i class="fa fa-dashboard"></i> Add Quiz</a>
                                    </li>
									
									 <li class="active">
                                        <a href="manage_quiz_master.php"><i class="fa fa-dashboard"></i> Manage Quiz</a>
                                    </li>
									
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from quiz_maste where flag='true' and id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<!--start edit--->
	
<form name="" method="post" action="quiz_master_do.php" id="txtQuizFrm">	
<div class="col-lg-12">
	<label>Quiz Title : </label>
	<input type="text" class="form-control" placeholder="Enter Title *" id="txt_q_title" name="txt_q_title" value="<?php echo $editQ_res['q_title']; ?>"><br>	
	
	<input type="hidden" value="<?php echo $editQ_res['id']; ?>" name="txtHide" id="txtHide">
	
	<label>Question : </label><br>	
	<a href="quiz_question_master.php" target="_blank">
		<button class="btn btn-sm btn-info" type="button">Add Question</button>
	</a>
	<button type="button" class="btn btn-sm btn-success selectQue">Select Question</button>
	<br><br>
	<span ><strong>Test Category : </strong>
	<div class="outerTestClassSec">
	<?php $qCatID=$editQ_res['q_cat_id_que_id'];

$QcatId=explode("|",$qCatID);
//echo count($QcatId);
for($i=0; $i<count($QcatId); $i++){
	 $QcatId_new=explode("-",$QcatId[$i]);
	$questionCatId=$QcatId_new[0];
	
	$questionId=$QcatId_new[1];
	$qCount=explode(",",$questionId);
	$qCount=count($qCount);
	
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
WHERE node.flag = 'true' AND node.id=$questionCatId
ORDER BY node.id DESC") or die("");

while($catQ_res=$catQ->fetch(PDO::FETCH_ASSOC)){
	?>
	<p id="tc_<?php echo $questionCatId; ?>" class="testClsClass">
		<?php echo $catQ_res['q_cat_title']; ?> | <?php echo $qCount; ?>
		&nbsp; <span class="edit_span" onClick="edit_sel_que('<?php echo $questionCatId; ?>','<?php echo $questionId; ?>');"><i class="fa fa-edit"></i></span> | 
		<a href="javascript:void(0);" id="tc_<?php echo $questionCatId; ?>-<?php echo $questionId; ?>" onClick="remove_test_cat('<?php echo $questionCatId; ?>','<?php echo $qCount; ?>')"> 
	<i class='fa fa-times'></i></a></p>
	<?php
	
}
	
	
}
	?>
	
		<!--<p class="testClsClass">Apptitude | 30
			<a href="javascript:void(0);"><i class="fa fa-times"></i></a>
		</p>
		-->		
	</div>
	
	<div style="clear:both;"></div>
	<br>	
	<input type="hidden" id="txtCatQue_id" name="txtCatQue_id">
	<label>Total Que : </label>
	<input type="number" class="form-control" id="txtSelTotalQue" name="txtSelTotalQue"  readonly value="<?php echo $editQ_res['q_total_que']; ?>"><br>	
	
	
	<div class="col-lg-6" style="padding-left:0px;">
	<label>Total Time : </label>
	<input type="number" class="form-control" placeholder="Total Time *" id="txt_total_time" name="txt_total_time" value="<?php echo $editQ_res['q_totl_time']; ?>"><br>
	</div>
	
	<div class="col-lg-6" style="padding-right:0px;">
	<label>Quiz Priority : </label>
	<input type="number" class="form-control" placeholder="Quiz Priority *" id="txt_q_priority" name="txt_q_priority" value="<?php echo $editQ_res['q_priority']; ?>"><br>
	</div>
	
</div>



<div class="col-lg-12">
	 <button class="btn btn-success btn-sm btn_final_submit" type="button">Submit</button>
	 <br><br>
</div>
							
</form>

<!---end edit--->
<?php	} else { ?>
                            
	
<form name="" method="post" action="quiz_master_do.php" id="txtQuizFrm">	
<div class="col-lg-12">
	<label>Quiz Title : </label>
	<input type="text" class="form-control" placeholder="Enter Title *" id="txt_q_title" name="txt_q_title"><br>	
	
	<input type="hidden" name="txtHide" id="txtHide">
	
	<label>Question : </label><br>	
	<a href="quiz_question_master.php" target="_blank">
		<button class="btn btn-sm btn-info" type="button">Add Question</button>
	</a>
	<button type="button" class="btn btn-sm btn-success selectQue">Select Question</button>
	<br><br>
	<span ><strong>Test Category : </strong>
	<div class="outerTestClassSec">
		<!--<p class="testClsClass">Apptitude | 30
			<a href="javascript:void(0);"><i class="fa fa-times"></i></a>
		</p>
		-->		
	</div>
	
	<div style="clear:both;"></div>
	<br>	
	<input type="hidden" id="txtCatQue_id" name="txtCatQue_id">
	<label>Total Que : </label>
	<input type="number" class="form-control" id="txtSelTotalQue" name="txtSelTotalQue" value="0" readonly><br>	
	
	<div class="col-lg-6" style="padding-left:0px;">
	<label>Total Time : </label>
	<input type="number" class="form-control" placeholder="Total Time *" id="txt_total_time" name="txt_total_time"><br>
	</div>
	
	<div class="col-lg-6" style="padding-right:0px;">
	<label>Quiz Priority : </label>
	<input type="number" class="form-control" placeholder="Quiz Priority *" id="txt_q_priority" name="txt_q_priority"><br>
	</div>
	
</div>


<div class="col-lg-12">
	 <button class="btn btn-success btn-sm btn_final_submit" type="button">Submit</button>
	 <br><br>
</div>
							
</form>

<?php } ?>



<div style="clear:both;"></div>
                    
					
					
					
                        </div>

						
						
						
                    </div>
                </div>
        </div>

	
	


		
		<script>
	$('input:checkbox').change(function(){
		if($(this).is(":checked")){
			$(this).addClass("chk_cat"); }
		else{
			$(this).removeClass("chk_cat");}
	});
	


<!---select Que--->
$(".selectQue").on("click",function(e){
	$("#selectQueModal").modal("show");	
	$("#que_list_Res").html('');
	
	$('#select_que_optn option[value="s_t_c"]').prop('selected', true);
	
	
	var empty_arry_list="";
	for(i=0; i<$(".outerTestClassSec p").length; i++){
		empty_arry_list=empty_arry_list+$(".outerTestClassSec p:eq("+i+")").attr('id');
		empty_arry_list=empty_arry_list+",";
	}
	empty_arry_list=empty_arry_list.slice(0,-1);
	empty_arry_list=empty_arry_list.replace(/tc_/g,'');
	empty_arry_list=empty_arry_list.split(",");
	//alert(empty_arry_list);
	$("#txt_old_cat_id").val(empty_arry_list);
	
	
	
});
<!---end select Que--->
</script>

<!---start modal--->

<div id="selectQueModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:0px; padding-top:15px; padding-bottom:15px; ">
      
	  
	  <div class="col-lg-2"></div>
	  <div class="col-lg-8">
		<label>Select Test Category : </label>
		<input type="hidden" id="txt_old_cat_id">
		
		<select class="form-control" id="select_que_optn">
			<option value="s_t_c">---Select Test Category---</option>
			<!---start--->
			<?php $m_Q=$db->query("SELECT
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
WHERE node.flag = 'true' 
ORDER BY node.id DESC") or die(""); 
										while($m_Q_res=$m_Q->fetch(PDO::FETCH_ASSOC)){ ?>
		<option value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['q_cat_title']; ?></option>
<?php } ?>
			<!---end--->
		</select>
	  </div>
	  <div class="col-lg-2"></div>
	  
	  
	  <div  style="clear:both;"></div>
	  
	  <div class="col-lg-12">
	  <br>
	  <div style="height:400px; overflow:auto;">
	  
	  <p align="center" id="filter_loader">
		<img src="loading2.gif" style="width:40px; height:40px;">
	  </p>
			<table class="table table-responsive table-striped table-bordered table-hover table-condensed">
				<thead style="background:#333; color:#fff;">
					<tr>
						<th>S No</th>
						<th>Option</th>
						<th>Question</th>
					</tr>
				</thead>
				
				<tbody id="que_list_Res">				
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
	  </div>
	  </div>
	  
	  <div  style="clear:both;"></div>
	  
	  
	  <div class="modal-footer">
	  <button type="button" class="btn btn-success btnSelQSubmit" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  
	  
	  
    </div>

  </div>
</div>
<!---end modal--->



	
	

<script>
$("#select_que_optn").on("change",function(e){
	
	var o_id=$("#txt_old_cat_id").val();
	o_id=o_id.split(',');
	
	//alert(o_id[0]);
	
	var selected_val=$("#select_que_optn option:selected").val();
	
	
	if($("#select_que_optn option:selected").val()=="s_t_c"){
		alert("Please Select Test Category !...");
	}
	
	else if(jQuery.inArray(selected_val,o_id)!=-1){
		alert("Question is already added in this category !... \n For Adding more Question Edit this Category before selecting Question !...");
		$("#que_list_Res").html('');
	}
	
	
	else{
		var cur_val=$("#select_que_optn option:selected").val();
		$("#que_list_Res").html('');
		$("#filter_loader").css("display","block");
		$.ajax({
			type:"POST",
			url:"filter_quiz_question_master.php",
			data:{sel_val:cur_val},
			success:function(r_data){
				//alert(r_data);
				$("#filter_loader").css("display","none");
				$("#que_list_Res").html(r_data);
			},error:function(err){
			location.reload();
			}
		});
	}
});




<!---select Que Submit--->
$(".btnSelQSubmit").on("click",function(e){
	var empty_list="";
	if($("#que_list_Res .chk_sel_q").length==0){
		alert("Please Select Question !....");
	}
	else{
		
	for(i=0; i<$("#que_list_Res .chk_sel_q").length; i++){
	empty_list=empty_list+$("#que_list_Res .chk_sel_q:eq("+i+")").attr('id');	
	empty_list=empty_list+",";
	}
	empty_list=empty_list.slice(0,-1);
		
	var selTestCat=$("#select_que_optn option:selected").val();
	var selTestCatName=$("#select_que_optn option:selected").html();	
	var selQueId=empty_list;
	
	
	
	var totalQues=selQueId.split(",");
	var totalQueCount=totalQues.length;	
	
	var oldToatlQue=$("#txtSelTotalQue").val();
	$("#txtSelTotalQue").val(parseInt(oldToatlQue)+parseInt(totalQueCount));
	
	
	//alert("Total Que :"+oldToatlQue);
	
	
	var newQid="'"+selTestCat+"'";
	 
	 var nQCount="'"+totalQueCount+"'";
	 
	 var r_onClick='onClick="remove_test_cat('+newQid+','+nQCount+')"';
	
	
	var appendVal="<p id='tc_"+selTestCat+"' class='testClsClass'>"+selTestCatName+" | "+totalQueCount+" &nbsp; <span class='edit_span' href='javascript:void(0);' onClick=edit_sel_que('"+selTestCat+"','"+selQueId+"');><i class='fa fa-edit'></i></span> | <a href='javascript:void(0);' id='tc_"+selTestCat+"-"+selQueId+"' "+r_onClick+" > <i class='fa fa-times'></i></a></p>"
	$(".outerTestClassSec").append(appendVal);
		
	$("#selectQueModal").modal("hide");
		
}


});
<!---end SelQ Submit--->

<!---remove test cat--->
function remove_test_cat(id,count_total){
	//alert(id);
	
	$("#tc_"+id).remove();
	
	/*---remove total question---*/
	var oldToatlQue=$("#txtSelTotalQue").val();
	$("#txtSelTotalQue").val(parseInt(oldToatlQue)-parseInt(count_total));
	
	
	
}
<!---end remove test cat--->
</script>


<!---save btn code--->
<script>
$(".btn_final_submit").on("click",function(e){
	var empty_test_cat_id="";
	var empty_test_cat_que_id="";
	for(i=0; i<$(".outerTestClassSec p a").length; i++){
		empty_test_cat_id=empty_test_cat_id+$(".outerTestClassSec p a:eq("+i+")").attr('id');	
		
		empty_test_cat_id=empty_test_cat_id+"|";
	}
	
	empty_test_cat_id=empty_test_cat_id.slice(0,-1);
	empty_test_cat_id=empty_test_cat_id.replace(/tc_/g, "");
	//alert(empty_test_cat_id); //testCatId-QueId|testCatId-QueId|testCatId-QueId.......
	
	$("#txtCatQue_id").val(empty_test_cat_id);
	
	
	/*txt_q_title
	txtHide
	txtCatQue_id
	txtSelTotalQue
	txt_total_time
	txt_q_priority
	txt_exam_cat_hide
	*/
	
	
	
	if($("#txt_q_title").val()=="" || $("#txt_q_title").val()==null){
		$("#txt_q_title").focus();
	}
	else if($("#txtCatQue_id").val()=="" || $("#txtCatQue_id").val()==null){
		alert("Please Select Question !...");
	}
	else if($("#txt_total_time").val()=="" || $("#txt_total_time").val()==null){
		$("#txt_total_time").focus();
	}
	else if($("#txt_q_priority").val()=="" || $("#txt_q_priority").val()==null){
		$("#txt_q_priority").focus();
	}
	
	else {
		//alert("All Ok");
		$("#txtQuizFrm").submit();
	}
});
</script>
<!---end save byn code--->



<!---edit selected que--->
<script>
function edit_sel_que(cat_id,que_id){
	//alert(cat_id+"-----"+que_id);
	$("#selectEditModal").modal("show");
	var qCountID=que_id.split(',');
	qCountID=qCountID.length;
	$("#totalCatSelectQue").val(qCountID);
	$("#edit_filter_loader").css("display","block");
	$("#e_select_que_res").html('');
	$.ajax({
			type:"POST",
			url:"filter_quiz_edit_question_master.php",
			data:{cat_id:cat_id,que_id:que_id},
			success:function(r_data){
				//alert(r_data);
				$("#edit_filter_loader").css("display","none");
				$("#e_select_que_res").html(r_data);
			},error:function(err){
			location.reload();
			}
		});
		
		
}
</script>
<!--end edit selected que--->	

<!---start edit modal--->
<style>
#edit_filter_loader{
	display:block;
}
</style>
<div id="selectEditModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:0px; padding-top:15px; padding-bottom:15px; ">
      
	  <input type="hidden" id="totalCatSelectQue">
	
	  <p align="center" id="edit_filter_loader">
            <img src="loading2.gif" style="width:40px; height:40px;">
        </p>
		
		
	<div id="e_select_que_res">
		
	
</div>	

<div class="modal-footer">
    <button type="button" class="btn btn-success btn_edit_submit">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>


    </div>

  </div>
</div>

<script>
$(".btn_edit_submit").on("click",function(e){
	var empty_list="";
	for(i=0; i<$("#edit_question_list .chk_e_sel_q").length; i++){
		empty_list=empty_list+$("#edit_question_list .chk_e_sel_q:eq("+i+")").attr('id');	
		empty_list=empty_list+",";
	}
	empty_list=empty_list.slice(0,-1);
	//alert($("#txt_edit_hidden_cat_id").val());
	
	
	var selTestCat=$("#txt_edit_hidden_cat_id").val();
	var selTestCatName=$("#txt_edit_cat_name").html();	
	var selQueId=empty_list;
	if(selQueId=="" || selQueId==0 || selQueId==null){
		alert("Please Select the Question !...");
	}
	else{
	var totalQues=selQueId.split(",");
	var totalQueCount=totalQues.length;	
	//alert(totalQueCount);
	
	var oldToatlQue=$("#txtSelTotalQue").val();
	
	//$("#txtSelTotalQue").val(parseInt(oldToatlQue)+parseInt(totalQueCount));
	
	
	var old_x= $("#totalCatSelectQue").val();
	var new_y=totalQueCount;	
	var final_value=$("#txtSelTotalQue").val();
	var z="";
	//alert(new_y);
	if(new_y>old_x){
		z=parseInt(new_y)-parseInt(old_x);
		final_value=parseInt(final_value)+parseInt(z);
		$("#txtSelTotalQue").val(final_value);
	}
	else if(old_x>new_y){
		z=parseInt(new_y)-parseInt(old_x);
		final_value=parseInt(final_value)+parseInt(z);
		$("#txtSelTotalQue").val(final_value);
	}
	else if(old_x==new_y){
		z=parseInt(old_x)-parseInt(new_y);
		final_value=parseInt(final_value)+parseInt(z);
		$("#txtSelTotalQue").val(final_value);
	}
	
	
	
	var newQid="'"+selTestCat+"'";
	 
	 var nQCount="'"+totalQueCount+"'";
	 
	 var r_onClick='onClick="remove_test_cat('+newQid+','+nQCount+')"';	
	
	var appendVal=""+selTestCatName+" | "+totalQueCount+" &nbsp; <span class='edit_span' href='javascript:void(0);' onClick=edit_sel_que('"+selTestCat+"','"+selQueId+"');><i class='fa fa-edit'></i></span> | <a href='javascript:void(0);' id='tc_"+selTestCat+"-"+selQueId+"' "+r_onClick+" > <i class='fa fa-times'></i></a>"
	//$(".outerTestClassSec").append(appendVal);
	
	$("#tc_"+selTestCat).html(appendVal);
	$("#selectEditModal").modal("hide");
	}
});
</script>

<!---end edit moal-->

	
    </body>

    </html>
    <?php
}
else
{
	header("location:../index.php");	
}
?>