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
	


	<script src="ckeditor.js"></script>
	<script src="samples/js/sample.js"></script>

	<link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
	<script src="js/jquery.min.js"></script>
	
</head>
<body>
<style>
.list_category_list ul{
list-style:none;
}
.list_category_list{
	padding-left:15px; list-style:none;
}
.list_category_list li{
	line-height:30px; 
}
</style>
    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <div class="col-lg-12">
                        <h4 align="center"><strong>Test Question Master</strong></h4>                         
					   <hr>                       
                       <ol class="breadcrumb">
                          <li class="active">
                                        <a href="test_category_master.php"><i class="fa fa-dashboard"></i> Add Test Category</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_test_category_master.php"><i class="fa fa-dashboard"></i> Manage Test Category</a>
                                    </li>
									
									 <li class="active">
                                        <a href="test_question_master.php"><i class="fa fa-dashboard"></i> Question Master</a>
                                    </li>
									
									 <li class="active">
                                        <a href="manage_test_question_master.php"><i class="fa fa-dashboard"></i> Manage  Question Master</a>
                                    </li>									
                        </ol>
                    </div>
		<?php if(isset($_REQUEST['id'])){
			$id=str_replace("'","",$_REQUEST['id']);
			$edit_q=$db->query("select id,que_title,optn_one,optn_two,optn_three,optn_four,optn_five,ans_no,
			que_priority,que_solution,que_cat_id from question_master where flag='true' and id=$id") or die("");
			$edit_q_res=$edit_q->fetch(PDO::FETCH_ASSOC);
?>
<form method="post" action="test_question_master_do.php" id="txt_form">
    <div class="col-lg-8">
        <label>Question Title</label>
		<div id="que_title_editor">
			<main>
                <div id="question_title" class="ckeditor"><?php echo $edit_q_res['que_title']; ?></div>
            </main>
            <script type="text/javascript">
                CKEDITOR.replace('question_title');
                CKEDITOR.add
            </script>
		</div>
		<input type="hidden" id="txt_question_title" name="txt_question_title">
				
		<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $edit_q_res['id']; ?>">	
		
        <br>
		
      
        <div class="col-lg-6" style="padding-left:0px;">
           <span>  <label>Option 1</label><br></span>
			<div id="que_optn_1_editor">
                <main>
                    <div id="question_option_1" class="ckeditor"><?php echo $edit_q_res['optn_one']; ?></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_1');
                    CKEDITOR.add
                </script>
			</div><input type="hidden" id="q_option_1" name="q_option_1"><br>
        </div>
        <div class="col-lg-6" style="padding-right:0px;">
            <div id="que_optn_2_editor">
                <span><label >Option 2</label><br></span>
				 <main>
                    <div id="question_option_2" class="ckeditor"><?php echo $edit_q_res['optn_two']; ?></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_2');
                    CKEDITOR.add
                </script>               
            </div><input type="hidden" id="q_option_2" name="q_option_2">
			<br>
        </div>
        <div class="col-lg-6" style="padding-left:0px;">
            <div id="que_optn_3_editor">
                <span> <label>Option 3</label><br>  </span>
				<main>
                    <div id="question_option_3" class="ckeditor"><?php echo $edit_q_res['optn_three']; ?></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_3');
                    CKEDITOR.add
                </script>                
            </div><input type="hidden" id="q_option_3" name="q_option_3">
			<br>
        </div>
		
        <div class="col-lg-6" style="padding-right:0px;">
            <div id="que_optn_4_editor">
                <span><label >Option 4</label><br></span>
				<main>
                    <div id="question_option_4" class="ckeditor"><?php echo $edit_q_res['optn_four']; ?></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_4');
                    CKEDITOR.add
                </script>                
            </div><input type="hidden" id="q_option_4" name="q_option_4"><br>
        </div>
        <div class="col-lg-6" style="padding-left:0px;">
            <div id="que_optn_5_editor">
                <span> <br> <label >Option 5</label><br></span>
				<main>
                    <div id="question_option_5" class="ckeditor"><?php echo $edit_q_res['optn_five']; ?></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_5');
                    CKEDITOR.add
                </script>
            </div><input type="hidden" id="q_option_5" name="q_option_5"><br>
        </div>
        <br>
        <div class="col-lg-12" style="padding:0px;">
            <br> <strong>Answer No.</strong>
            <br>
            <input type="text" name="answer_no" value="<?php echo $edit_q_res['ans_no']; ?>" id="answer_no" placeholder="Answer No." class="form-control">
            <br>
            <strong>Priority</strong>
            <input type="number" value="<?php echo $edit_q_res['que_priority']; ?>"  name="txt_priority" class="form-control" id="txt_priority" placeholder="Priority *">
            <br>
			
            <div id="solution_editor">
                <strong>Solution</strong>

                <main>
                    <div id="sol_ans" class="ckeditor"><?php echo $edit_q_res['que_solution']; ?></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('sol_ans');
                    CKEDITOR.add
                </script>

                <script>
                    initSample();
                </script>
            </div>
			<input type="hidden" id="que_solution" name="que_solution">
        </div>
    </div>
    <div class="col-lg-4">

               
<?php 
function parent_child($id){
	
	$db = new PDO('mysql:host=localhost;dbname=sensible_sensible;charset=utf8mb4', 'sensible_sen', 'sensible@123#'); 
	$q2=$db->query("select id,q_cat_title from online_test_category where q_cat_parent=$id") or die("");
	while($r2=$q2->fetch(PDO::FETCH_ASSOC)){  $id=$r2['id'];
?>
	<ul>
		<li><span><input type="checkbox" id="<?php echo $id; ?>" class="check_cat"></span>
			<?php echo $r2['q_cat_title']; ?>  
			<?php
				$count=$q2->rowCount();
				if($count!=0){			
				}		 
				else{									 
				}
			?>                                 				
			<span><?php $count=$q2->rowCount();
				if($count=0){
					break;
				}
				else{ 
					parent_child($id);
				}
				?>
			</span>
		</li>
	</ul>
<?php	
	}
	?>
	<?php
	}
?>       

                    <div style="background:#333; color:#fff; padding:6px;">
                        <label>Test Category:</label>
                    </div>
                    <div style="border:1px solid #333;">
 <ul class="list_category_list">
											   <input type="hidden" id="txtEditCatId" value="<?php echo $edit_q_res['que_cat_id']; ?>">
											   
       <?php $q1=$db->query("select id,q_cat_title from online_test_category where q_cat_parent=0") or die("");
	  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
                                                       <li><span><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat"></span> 
                                                    <?php echo $r1['q_cat_title']; ?><span> </span>

                                                    <?php 
													 parent_child($m_id);
					?>

                                                        </li>

                                                        <?php } ?>
                                                </ul>
                        <input type="hidden" name="txt_test_cat_hide" id="txt_test_cat_hide">
                    </div>
    </div>
    <div class="col-lg-12">
        <br>
        <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
        <br>
        <br>
    </div>

</form>
<?php
		} else { ?>
<!---start--->
<form method="post" action="test_question_master_do.php" id="txt_form">
    <div class="col-lg-8">
        <label>Question Title</label>
		<div id="que_title_editor">
			<main>
                <div id="question_title" class="ckeditor"></div>
            </main>
            <script type="text/javascript">
                CKEDITOR.replace('question_title');
                CKEDITOR.add
            </script>
		</div>
		<input type="hidden" id="txt_question_title" name="txt_question_title">
				
		<input type="hidden" name="txt_hide" id="txt_hide">	
		
        <br>
		
      
        <div class="col-lg-6" style="padding-left:0px;">
           <span>  <label>Option 1</label><br></span>
			<div id="que_optn_1_editor">
                <main>
                    <div id="question_option_1" class="ckeditor"></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_1');
                    CKEDITOR.add
                </script>
			</div><input type="hidden" id="q_option_1" name="q_option_1"><br>
        </div>
        <div class="col-lg-6" style="padding-right:0px;">
            <div id="que_optn_2_editor">
                <span><label >Option 2</label><br></span>
				 <main>
                    <div id="question_option_2" class="ckeditor"></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_2');
                    CKEDITOR.add
                </script>               
            </div><input type="hidden" id="q_option_2" name="q_option_2">
			<br>
        </div>
        <div class="col-lg-6" style="padding-left:0px;">
            <div id="que_optn_3_editor">
                <span> <label>Option 3</label><br>  </span>
				<main>
                    <div id="question_option_3" class="ckeditor"></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_3');
                    CKEDITOR.add
                </script>                
            </div><input type="hidden" id="q_option_3" name="q_option_3">
			<br>
        </div>
		
        <div class="col-lg-6" style="padding-right:0px;">
            <div id="que_optn_4_editor">
                <span><label >Option 4</label><br></span>
				<main>
                    <div id="question_option_4" class="ckeditor"></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_4');
                    CKEDITOR.add
                </script>                
            </div><input type="hidden" id="q_option_4" name="q_option_4"><br>
        </div>
        <div class="col-lg-6" style="padding-left:0px;">
            <div id="que_optn_5_editor">
                <span> <br> <label >Option 5</label><br></span>
				<main>
                    <div id="question_option_5" class="ckeditor"></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('question_option_5');
                    CKEDITOR.add
                </script>
            </div><input type="hidden" id="q_option_5" name="q_option_5"><br>
        </div>
        <br>
        <div class="col-lg-12" style="padding:0px;">
            <br> <strong>Answer No.</strong>
            <br>
            <input type="text" name="answer_no" id="answer_no" placeholder="Answer No." class="form-control">
            <br>
            <strong>Priority</strong>
            <input type="number" name="txt_priority" class="form-control" id="txt_priority" placeholder="Priority *">
            <br>
			
            <div id="solution_editor">
                <strong>Solution</strong>

                <main>
                    <div id="sol_ans" class="ckeditor"></div>
                </main>
                <script type="text/javascript">
                    CKEDITOR.replace('sol_ans');
                    CKEDITOR.add
                </script>

                <script>
                    initSample();
                </script>
            </div>
			<input type="hidden" id="que_solution" name="que_solution">
        </div>
    </div>
    <div class="col-lg-4">

       

                    <div style="background:#333; color:#fff; padding:6px;">
                        <label>Test Category:</label>
                    </div>
                    <div style="border:1px solid #333;">
<ul id="treeview" class="hummingbird-base list_category_list">
	<?php 
		$q1=$db->query("select id,q_cat_title from online_test_category where q_cat_parent=0") or die("query");
		while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
		<!--start level 1--->
		<li>
		<label><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat">
			<?php echo $r1['q_cat_title']; ?></label>
			<ul>
				<?php
				$q2=$db->query("select id,q_cat_title from online_test_category where q_cat_parent=$m_id") or die("query");
				while($r2=$q2->fetch(PDO::FETCH_ASSOC)){ $m_id1=$r2['id'];
				?>
				<!---start level 2--->
				<li>
				<label><input type="checkbox" id="<?php echo $m_id."-".$m_id1; ?>" class="check_cat">
				<?php echo $r2['q_cat_title']; ?></label> 
					<ul>
						<?php
						$q3=$db->query("select id,q_cat_title from online_test_category where q_cat_parent=$m_id1") or die("query");
						while($r3=$q3->fetch(PDO::FETCH_ASSOC)){ $m_id2=$r3['id'];
						?>
						<!---start level 3--->
						<li>
						<label><input type="checkbox" id="<?php echo $m_id."-".$m_id1."-".$m_id2; ?>" class="check_cat"> 
						<?php echo $r3['q_cat_title']; ?> </label>
							<ul>
								<?php
								$q4=$db->query("select id,q_cat_title from online_test_category where q_cat_parent=$m_id2") or die("query");
								while($r4=$q4->fetch(PDO::FETCH_ASSOC)){ $m_id3=$r3['id'];
								?>
								<!---start level 4--->
								<li>
								<label><input type="checkbox" id="<?php echo $m_id."-".$m_id1."-".$m_id2."-".$m_id3; ?>" class="check_cat">
								<?php echo $r4['q_cat_title']; ?> </label>
								</li>
								<!---end level 4--->
								<?php } ?>
							</ul>
						
						</li>
						<!---end level 3--->
						<?php } ?>
					</ul>
				</li>
				<!---end level 2---->
				<?php } ?>
			</ul>
		</li>
		<!--end level 1--->
		<?php } ?>
</ul>
                        <input type="hidden" name="txt_test_cat_hide" id="txt_test_cat_hide">
                    </div>
    </div>
    <div class="col-lg-12">
        <br>
        <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
        <br>
        <br>
    </div>

</form>
<!---end--->  
		<?php } ?>              
                </div>
                
            </div>
        </div>
   </div>
   
   
 
<script src="hummingbird-treeview.js"></script>
    <script>
        $("#treeview").hummingbird();
		
		
		$('input:checkbox').change(function(){
		if($(this).is(":checked")){
			$(this).addClass("chk_cat"); }
		else{
			$(this).removeClass("chk_cat");}
	});
	
	
    </script>

                    
<script>
$(".btn_submit").on("click", function(e){
	var que_title_editor = $('#cke_question_title #cke_1_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	var que_optn_1_editor = $('#cke_question_option_1 #cke_2_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	var que_optn_2_editor = $('#cke_question_option_2 #cke_3_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	var que_optn_3_editor = $('#cke_question_option_3 #cke_4_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	var que_optn_4_editor = $('#cke_question_option_4 #cke_5_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	var que_optn_5_editor = $('#cke_question_option_5 #cke_6_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	var solution_editor = $('#cke_sol_ans #cke_7_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	
	$("#txt_question_title").val(que_title_editor);
	$("#q_option_1").val(que_optn_1_editor);
	$("#q_option_2").val(que_optn_2_editor);
	$("#q_option_3").val(que_optn_3_editor);
	$("#q_option_4").val(que_optn_4_editor);
	$("#q_option_5").val(que_optn_5_editor);
	$("#que_solution").val(solution_editor);
	
	var empty_cat="";
	for(i=0; i<$(".list_category_list .chk_cat").length; i++){
		empty_cat=empty_cat+$(".list_category_list .chk_cat:eq("+i+")").attr('id');
		empty_cat=empty_cat+",";
	}
		empty_cat=empty_cat.slice(0,-1);
		empty_cat=empty_cat.replace(/-/gi, ",");
	//alert(empty_cat);
	$("#txt_test_cat_hide").val(empty_cat);
	
	if($("#txt_question_title").val()=="" || $("#txt_question_title").val()==null){
		alert("Enter Question Title !...");
	}
	else if($("#q_option_1").val()=="" || $("#q_option_1").val()==null){
		alert("Enter Option 1 !...");
	}
	else if($("#q_option_2").val()=="" || $("#q_option_2").val()==null){
		alert("Enter Option 2 !...");
	}
	else if($("#q_option_3").val()=="" || $("#q_option_3").val()==null){
			alert("Enter Option 3 !...");
	}
	else if($("#q_option_4").val()=="" || $("#q_option_4").val()==null){
		alert("Enter Option 4 !...");
	}
	else if($("#txt_priority").val()=="" || $("#txt_priority").val()==null){
		$("#txt_priority").focus();
	}
	else if($("#answer_no").val()=="" || $("#answer_no").val()==null){
		$("#answer_no").focus();
	}	
	else if($("#txt_test_cat_hide").val()=="" || $("#txt_test_cat_hide").val()==null){
			alert("Select Test Category !...");
	}
	else {
		$("#txt_form").submit();
	}
		
});
</script>
			   
			   
			   
<?php if(isset($_REQUEST['id'])){
?>
<script>
var empty_list="";
		var e_list=$("#txtEditCatId").val();
		
		e_list=e_list.split(",");
		
for(i=0; i<$(".list_category_list .check_cat").length; i++){
	empty_list=empty_list+$(".list_category_list .check_cat:eq("+i+")").attr('id');
	
	for(j=0; j<e_list.length; j++){
		if(i==j){
			console.log("Y---"+e_list[j]);
			$("#"+e_list[j]).addClass("chk_cat");
			$("#"+e_list[j]).prop('checked', true);
	}
	else{
		console.log("N");
	}
	}
	
	empty_list=empty_list+",";
}
empty_list=empty_list.slice(0,-1);
</script>
<?php } else { } ?>	


</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>