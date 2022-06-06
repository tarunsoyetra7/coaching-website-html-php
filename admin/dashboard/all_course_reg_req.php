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
		<?php     	include("header.php");    ?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>Course Registration Request</strong></h4><hr>
						
						
						<br>
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12"><br>
                    	
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>User Detail</th>
									<th>Course Name</th>
									<th>Registration Date</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $q=$db->query("SELECT u_email_id,u_c_no,u_name,id,(SELECT c_title FROM course_master WHERE id=course_name) AS course_name,
							DATE_FORMAT(created_date,'%d %M %Y') AS created_date FROM req_req WHERE flag='true'ORDER BY id desc") or die("");
							 $i=0;
								while($result=$q->fetch(PDO::FETCH_ASSOC)){ $i++; ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td>
										<strong>Name : </strong><?php echo $result['u_name']; ?><br>
										<strong>Email : </strong><?php echo $result['u_email_id']; ?><br>
										<strong>Contact No : </strong><?php echo $result['u_c_no']; ?>
									</td>
									<td><?php echo $result['course_name']; ?></td>
									<td><?php echo $result['created_date']; ?></td>
									<td>
										<a href="del_reg_req_course_page.php?del_id=<?php echo $result['id']; ?>"><strong>Delete</strong></a>
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
	  


$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_latest_news.php",
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
			url:"restore_latest_news.php",
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
			url:"enable_latest_news.php",
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
		window.location.replace("latest_news_master.php?id="+cur_id);
	});
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_latest_news.php",
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