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
    <div id="wrapper">
		<?php     	include("header.php");      	?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>Manage Current Affair Detail</strong></h4><hr>
						
						
						 <ol class="breadcrumb">

                                  <li class="active">
                                        <a href="current_affair_category_master.php"><i class="fa fa-dashboard"></i> Add Current Affair Category</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_current_affair_category_master.php"><i class="fa fa-dashboard"></i> Manage Current Affair Category</a>
                                    </li>
									
									<li class="active">
                                        <a href="current_affair_detail_master.php"><i class="fa fa-dashboard"></i> Add Current Affair Detail</a>
                                    </li>
									
									<li class="active">
                                        <a href="manage_current_affair_detail_master.php"><i class="fa fa-dashboard"></i> Manage Current Affair Detail</a>
                                    </li>


                                            </ol>
						
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
                    	<div class="col-lg-3"></div>
					 <div class="col-lg-6">

                                    <label>Select Current Affair Category</label>
                                    <select class="form-control" name="sel_menu_cat" id="sel_menu_cat">
                                        <option value="s_m">---Select Category---</option>
										<?php $m_Q=$db->query("SELECT
node.id,
    node.cat_parent_id,
    CONCAT(IFNULL(up3.cat_title, ''), IFNULL(CONCAT(up2.cat_title, ' --> '), ''), IFNULL(CONCAT(up1.cat_title, ' --> '), ''), node.cat_title) AS cat_title
FROM current_affair_category_master AS node
LEFT OUTER JOIN current_affair_category_master AS up1
ON up1.id = node.cat_parent_id
LEFT OUTER JOIN current_affair_category_master AS up2
ON up2.id = up1.cat_parent_id
LEFT OUTER JOIN current_affair_category_master AS up3
ON up3.id = up2.cat_parent_id
WHERE node.flag = 'true' 
ORDER BY node.id DESC") or die(""); while($m_Q_res=$m_Q->fetch(PDO::FETCH_ASSOC)){ ?>
		<option value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['cat_title']; ?></option>
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
                                    <th>Title</th>
									<th>Category</th>
									
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody id="filter_Res">
							<?php $query=$db->query("select id,ca_title,ca_cat_id,created_on,
							e_d_optn,flag from current_affair_detail order by id desc") or die("");
 $i=0;
while($result=$query->fetch(PDO::FETCH_ASSOC)){			$i++;				?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['ca_title']; ?><br>
								<strong>Created On : </strong><?php echo $result['created_on']; ?>
								</td>
								<td>
								<?php $cat_id=$result['ca_cat_id'];
								
										$catQ=$db->query("select group_concat(cat_title) as cat_title 
										from current_affair_category_master where find_in_set(id,'$cat_id')") or die("");
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
							<?php } ?>
                            </tbody>
                        </table>	
                    </div>                    
				</div>
			</div>
		</div>
</div>

<script>
$("#sel_menu_cat").on("change",function(e){
	if($("#sel_menu_cat option:selected").val()=="s_m"){		
		$("#sel_menu_cat").focus();
		alert("Select Menu Category !....");
	}
	else{
		var sel_val=$("#sel_menu_cat option:selected").val();
		$("#filter_loader").css("display","block");
		$.ajax({
			type:"POST",
			url:"filter_current_affair_category_detail.php",
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
</script>  
<script>
  $(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("current_affair_detail_master.php?id="+cur_id);
	});
	
	
$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_current_affair_detail_master.php",
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
			url:"restore_current_affair_detail_master.php",
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
			url:"enable_current_affair_detail_master.php",
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
			url:"disable_current_affair_detail_master.php",
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
</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>