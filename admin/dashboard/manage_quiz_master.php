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
						<h4 align="center"><strong>Manage Quiz Master</strong></h4><hr>
						
						
						 <ol class="breadcrumb">

                                   
                                                <li class="active">
                                        <a href="quiz_master.php"><i class="fa fa-dashboard"></i> Add Quiz</a>
                                    </li>
									
									 <li class="active">
                                        <a href="manage_quiz_master.php"><i class="fa fa-dashboard"></i> Manage Quiz</a>
                                    </li>

 
									
									
                                </ol>
					
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
					
					
                    	
						
 
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Quiz Detail</th>
									 <th>Quiz Question</th>
									<th>Priority</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody id="filter_Res">
							<?php $query=$db->query("select id,q_title, 
             q_cat_id_que_id, 
             q_total_que, e_d_optn,flag,
             q_totl_time ,q_priority
              from
							quiz_maste order by id desc") or die(""); $i=0;
								while($result=$query->fetch(PDO::FETCH_ASSOC)){ $i++;
								?>
							<tr>
								<td><?php echo $i;  ?></td>
								<td>
								
								<strong>Quiz Title : </strong><?php echo $result['q_title']; ?><br>
								<strong>Total Que : </strong><?php echo $result['q_total_que']; ?><br>
								<strong>Total Time  : </strong><?php echo $result['q_totl_time']; ?>
					</td>
							<td>
							
							
								<button class="btn btn-sm btn-info btnViewQue" id="<?php echo $result['id']; ?>" type="button">View Question</button>
							

</td>							
<td><?php echo $result['q_priority']; ?></td>							
							<td>
								
								
								
								
								<button id="<?php echo $result['id']; ?>" class="btn btn-sm btn-info btn_edit">Edit</button>			
						
									<?php if($result['e_d_optn']=='true'){
?>
<span class="enable_button" id="button_<?php echo $result['id']; ?>">
	<button class="btn btn-sm btn-success" onClick="btn_disable(<?php echo $result['id']; ?>);" id="mbtn_<?php echo $result['id']; ?>">Enable</button>
</span>
<?php	} else {
?>
<span class="disable_button" id="button_<?php echo $result['id']; ?>">
	<button class="btn btn-sm btn-danger"  onClick="enable_btn(<?php echo $result['id']; ?>)"  id="mbtn_<?php echo $result['id']; ?>">Disable</button>
</span>
<?php
	} ?>
<img src="loading2.gif" style="width:30px; height:30px;" class="pull-right loader_image" id="lo_<?php echo $result['id']; ?>">




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
<script>
$("#sel_blog_cat").on("change",function(e){
	if($("#sel_blog_cat option:selected").val()=="s_m"){		
		$("#sel_blog_cat").focus();
		alert("Select Blog Category !....");
	}
	else{
		var sel_val=$("#sel_blog_cat option:selected").val();
		$("#filter_loader").css("display","block");
		$.ajax({
			type:"POST",
			url:"filter_blog_category_detail.php",
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
</script>

    
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
	  
	  

	  /*
	  
	  
$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_quiz_master.php",
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
			url:"restore_quiz_master.php",
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
			url:"enable_quiz_master.php",
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
	
	
		$(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("quiz_master.php?id="+cur_id);
	});
	/*
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_quiz_master.php",
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
</script>  


<script>
$(".btnViewQue").on("click",function(e){
	$("#selectQueModal").modal("show");
	var cur_id=$(this).attr('id');
	$("#fetch_res").html('');
	$("#filter_loader").css("display","block");
	$.ajax({
			type:"POST",
			url:"fetch_manage_quiz_que.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				$("#filter_loader").css("display","none");
				//alert(r_data);
				$("#fetch_res").html(r_data);
				
			},error:function(err){
			location.reload();
			}
	});
		
		
});




function enable_btn(id){
		var cur_id=id;
		
		$("#lo_"+cur_id).css("visibility","visible");		
		
		$("#mbtn_"+cur_id).prop("disabled",true);
		
		$.ajax({
			type:"POST",
			url:"enable_quiz_master.php",
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
			url:"disable_quiz_master.php",
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
<!---start modal--->
<style>
#filter_loader{
	display:none;
}
</style>
<div id="selectQueModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:0px; padding-top:15px; padding-bottom:15px; ">
      
	  <div class="col-lg-12">
	  <br>
	    <p align="center" id="filter_loader">
		<img src="loading2.gif" style="width:40px; height:40px;">
	  </p>
	  
	  
	  <div style="height:400px; overflow:auto;" id="fetch_res">
	  
		<h4>Que Category title</h4>
			<table class="table table-responsive table-striped table-bordered table-hover table-condensed">
				<thead style="background:#333; color:#fff;">
					<tr>
						<th>S No</th>
						<th>Option</th>						
					</tr>
				</thead>				
				<tbody>				
					<tr>
						<td></td>
						<td></td>					
					</tr>
				</tbody>
			</table>
			<hr>
	  </div>
	  </div>
	  
	  <div  style="clear:both;"></div>
	  
	  
	  <div class="modal-footer">
		<!--<button type="button" class="btn btn-danger btnRemoveQue" >Remove Selected Question</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  
	  
	  
    </div>

  </div>
</div>
<!---end modal--->
<!---remove--->
<script>
$(".btnRemoveQue").on("click",function(e){
	for(i=0; i<$(".r_q_cls").length; i++){
		
	}
});
</script>
<!---end remove--->

</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>