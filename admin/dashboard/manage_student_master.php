<?php if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];	
	
	if($login_id==1){
		$selCondition="";
	}else{
		$selCondition="where created_by=$login_id";
	}
	
	
	if($login_id==1){
		$display_sec="
			<li class='active'>
                <a href='employee_transcation_history_admin.php'>
					<i class='fa fa-dashboard'></i> 
						All Transaction History
				</a>
            </li>
		";		
	}
	else{
		$display_sec="";
	}
	
	
	
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
	
	
	<script src="js/jquery.dataTables.min.js"></script>
		

</head>
<body>
    <div id="wrapper">
		<?php     include("header.php");      	?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>Manage Course Master</strong></h4><hr>
						
						
						 <ol class="breadcrumb">
                          
                                    <li class="active">
                                        <a href="student_master.php"><i class="fa fa-dashboard"></i> Student Master</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_student_master.php"><i class="fa fa-dashboard"></i> Manage Student</a>
                                    </li>
									
									 <li class="active">
                                        <a href="recived_amount_master.php"><i class="fa fa-dashboard"></i> Recived Amount Master</a>
                                    </li>
									
									 <li class="active">
                                        <a href="installment_master.php"><i class="fa fa-dashboard"></i> Installment Master</a>
                                    </li>
									
									
									 <li class="active">
                                        <a href="employee_transcation_history.php"><i class="fa fa-dashboard"></i> Transaction History</a>
                                    </li>
									
									
									<?php echo $display_sec; ?>
							
                        </ol>
						<br>
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
                   
								<a href="export_to_excel.php" target="_blank"><b>Export to Excel</b></a>
                 
				 
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Student Detail</th>
                                    
                                    <th>Education Detail</th>
                                     <th>Course Name</th>
                                      <th>Fees Detail</th>
									<th>Option</th>
                                </tr>
                            </thead>
                          <tbody>
							<?php 
							
							
	$query=$db->query("SELECT *,(SELECT c_title FROM course_master 
	WHERE student_master.stud_course=course_master.id) AS stud_course_name 
FROM student_master  $selCondition ORDER BY student_master.id desc") or die(""); $i=0;
	while($result=$query->fetch(PDO::FETCH_ASSOC)){ $i++;

 ?>
							<tr>
							<td><?php echo $i; ?></td>
								<td>
							<strong> Name :&nbsp;</strong><?php echo $result['stud_name']; ?><br>
							<strong>Address:&nbsp;</strong><?php echo $result['stud_add']; ?><br>	
                            <strong>Mobile No.:&nbsp;</strong><?php echo $result['stud_mo']; ?>	<br>
							<strong>Reg Date :&nbsp;</strong><?php echo $result['created_on']; ?>	
								</td>
                                
                                <td>
								
					<strong> Branch:&nbsp;</strong><?php echo $result['stud_branch']; ?><br>
							<strong>Sem:&nbsp;</strong><?php echo $result['stud_sem']; ?><br>	
                            <strong>College:&nbsp;</strong><?php echo $result['stud_clg_name']; ?>
								</td>
                                
                                 <td>
								
					<?php echo $result['stud_course_name']; ?>
								</td>
								 <td>
								
					<strong> Total: </strong><?php echo $result['stud_fees']; ?><br>
							<strong>Discount:&nbsp; </strong><?php echo $result['stud_discount']; ?><br>	
                            <strong>Paid:&nbsp; </strong><?php echo $result['stud_paid_amnt']; ?><br>
                            <strong>Balance:&nbsp; </strong><?php echo $result['stud_balance']; ?>
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
		
<?php } ?>
				<br><br>
<a target="_blank" href="recipt_page.php?id=<?php echo $result['id']; ?>"><strong>Print Recipt</strong></a>


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
$(document).ready(function() {

        
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
} );
	 
	  

	$(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("student_master.php?id="+cur_id);
	});

$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_student_master.php",
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
			url:"restore_student_master.php",
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
			url:"enable_student_master.php",
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
			url:"disable_student_master.php",
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