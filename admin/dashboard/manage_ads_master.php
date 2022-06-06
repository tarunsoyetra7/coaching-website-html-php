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
    <div id="wrapper">
		<?php     	include("header.php");      	?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>Manage Ads Master</strong></h4><hr>
						
						
						  <ol class="breadcrumb">

                                   
                                                <li class="active">
                                        <a href="ads_master.php"><i class="fa fa-dashboard"></i> Add Ads</a>
                                    </li>
									
									 <li class="active">
                                        <a href="manage_ads_master.php"><i class="fa fa-dashboard"></i> Manage Ads</a>
                                    </li>

                                  
									
									
                                </ol>
						<br>
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12"><br>
                    	
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Ads Detail</th>
									<th>Ads Image</th>
									<th>Ads Target Location</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $q=$db->query("select * from ads_master order by id desc") or die(""); $i=0;
								while($result=$q->fetch(PDO::FETCH_ASSOC)){ $i++;
									$cat_id=$result['a_sel_loc'];
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td>
									<strong>Title : </strong> <?php echo $result['a_title']; ?><br>
									<strong>URL : </strong> <?php echo $result['a_url']; ?><br>
									<strong>Priority : </strong><?php echo $result['a_priority']; ?>
									
									</td>
									<td>
										<img src="../../ads_img/<?php echo $result['id'].".".$result['a_img']; ?>" style="width:70px; height:70px;">
									</td>
									
									<td>
										<?php $newQ=$db->query("SELECT GROUP_CONCAT(s_loc_name) AS a_name
										FROM sel_loc_master WHERE FIND_IN_SET(id,'$cat_id')") or die(""); 
										$newQ_res=$newQ->fetch(PDO::FETCH_ASSOC);
										echo $newQ_res['a_name'];
										?>
										
									</td>
									
									
									<td><?php if($result['flag']=='true'){ ?>
								
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
	  


$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_ads_master.php",
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
			url:"restore_ads_master.php",
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
			url:"enable_ads_master.php",
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
		window.location.replace("ads_master.php?id="+cur_id);
	});
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_ads_master.php",
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