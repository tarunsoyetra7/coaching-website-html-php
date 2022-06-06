<?php if(isset($_COOKIE['login']))
{	
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
     <link rel="stylesheet" href="css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  
    
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- data tables -->
    <script src="js/jquery.dataTables.min.js"></script>
	
	
</head>
<body>
<style>
#filter_loader{
	display:none;
}
</style>
	
<style>
.loader_image{
	visibility:hidden;
}
</style>
    <div id="wrapper">
		<?php     	include("header.php");      	?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>Manage Quiz Question Master</strong></h4><hr>
						
						
						 <ol class="breadcrumb">
                           	 <li class="active">
                                        <a href="quiz_question_master.php"><i class="fa fa-dashboard"></i> Quiz Question Master</a>
                                    </li>
									
									 <li class="active">
                                        <a href="manage_quiz_question_master.php"><i class="fa fa-dashboard"></i> Manage  Quiz Question Master</a>
                                    </li>	
							
                        </ol>
						
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
					<div class="col-lg-3"></div>
					 <div class="col-lg-6">

                                    <label>Select Question Category</label>
                                    <select class="form-control" name="sel_blog_cat" id="sel_blog_cat">
                                        <option value="s_m">---Select Category---</option>
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
                                    </select>
                                  
                                </div>
						<div class="col-lg-3"></div>
						<div style="clear:both;"></div>
                    	<div class="col-lg-12"><hr></div>
						<p align="center" id="filter_loader"><img src="loading2.gif" style="width:60px; height:60px;"></p>
 
 
 
                    	
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Que Title</th>
									<th>Ans No</th>
									<th>Test Category</th>
									<th>Priority</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody id="filter_Res">
							<?php $queQ=$db->query("select id,que_title,ans_no,que_cat_id,created_on,e_d_optn,
							flag,que_priority from quiz_question_master order by id desc") or die(""); $i=0;
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
								<?php } ?>
                            </tbody>
                        </table>	
                    </div>                    
				</div>
			</div>
		</div>
</div>
    
<script type="text/javascript">    
	$(function () {
	  
		$('#example1').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		   dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
		});
	  });

	  
	  
	 $(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("quiz_question_master.php?id="+cur_id);
	});  
	/*  

$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_quiz_question_master.php",
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
			url:"restore_quiz_question_master.php",
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
			url:"enable_quiz_question_master.php",
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
			url:"disable_quiz_question_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
*/
$("#sel_blog_cat").on("change",function(e){
	if($("#sel_blog_cat option:selected").val()=="s_m"){		
		$("#sel_blog_cat").focus();
		alert("Select Category !....");
	}
	else{
		var sel_val=$("#sel_blog_cat option:selected").val();
		$("#filter_loader").css("display","block");
		$.ajax({
			type:"POST",
			url:"filter_quiz_que_master.php",
			data:{sel_val:sel_val},
			success:function(r_data){
				//alert(r_data);
				$("#filter_loader").css("display","none");
				$("#filter_Res").html(r_data);
			},error:function(err){
			location.reload();
			}
		});
	}
});



function enable_btn(id){
		var cur_id=id;
		
		$("#lo_"+cur_id).css("visibility","visible");		
		
		$("#mbtn_"+cur_id).prop("disabled",true);
		
		$.ajax({
			type:"POST",
			url:"enable_quiz_question_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
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
	
	
	
	function btn_disable(id){
		var cur_id=id;
		$("#lo_"+cur_id).css("visibility","visible");
		$("#mbtn_"+cur_id).prop("disabled",true);
		$.ajax({
			type:"POST",
			url:"disable_quiz_question_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
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
</script>  
</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>