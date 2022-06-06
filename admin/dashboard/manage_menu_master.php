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
						<h4 align="center"><strong>Manage Menu Master</strong></h4><hr>
						
						
						 <ol class="breadcrumb">
                          <li class="active">
                                        <a href="menu_master.php"><i class="fa fa-dashboard"></i> Add Menu</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_menu_master.php"><i class="fa fa-dashboard"></i> Manage Menu</a>
                                    </li>
									
									<li class="active">
                                        <a href="menu_detail.php"><i class="fa fa-dashboard"></i> Add Detail</a>
                                    </li>
									
									<li class="active">
                                        <a href="manage_menu_detail.php"><i class="fa fa-dashboard"></i> Manage Detail</a>
                                    </li>
							
                        </ol>
						<br>
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
					
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Menu Detail</th>
									<th>Priority</th>
									<th>Display</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $query=$db->query("SELECT
node.id,node.m_img,node.m_priority,node.flag,node.e_d_optn,node.menu_display,node.home_display,
    node.m_parent_id,
    CONCAT(IFNULL(up3.m_title, ''), IFNULL(CONCAT(up2.m_title, ' --> '), ''), IFNULL(CONCAT(up1.m_title, ' --> '), ''), node.m_title) AS m_title
FROM menu_master AS node
LEFT OUTER JOIN menu_master AS up1
ON up1.id = node.m_parent_id
LEFT OUTER JOIN menu_master AS up2
ON up2.id = up1.m_parent_id
LEFT OUTER JOIN menu_master AS up3
ON up3.id = up2.m_parent_id

ORDER BY node.id desc") or die(""); $i=0;
	while($result=$query->fetch(PDO::FETCH_ASSOC)){ $i++;

 ?>
							<tr>
							<td><?php echo $i; ?></td>
								<td>
								<?php if($result['m_img']=="" || $result['m_img']==NULL){ } else { ?>
									<img src="../../menu_image/<?php echo $result['id'].".".$result['m_img']; ?>" style="width:30px; height:30px;">
								<?php } ?>
								<?php echo $result['m_title']; ?>
								
								</td>
								
								<td><?php echo $result['m_priority']; ?></td>
								<td><strong>Header Menu : </strong><?php echo $result['menu_display']; ?><br>
								<strong>Home Page : </strong><?php echo $result['home_display']; ?></td>
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
		window.location.replace("menu_master.php?id="+cur_id);
	});

/*$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_menu_master.php",
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
			url:"restore_menu_master.php",
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
	
	function enable_btn(id){
		var cur_id=id;
		
		$("#lo_"+cur_id).css("visibility","visible");		
		
		$("#mbtn_"+cur_id).prop("disabled",true);
		
		$.ajax({
			type:"POST",
			url:"enable_menu_master.php",
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
			url:"disable_menu_master.php",
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