<?php if(isset($_COOKIE['login'])){	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");
	
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
		<?php  include("header.php");  ?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>All Transcation History</strong></h4><hr>
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
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">
                        	<thead style="background:#000; color:#fff;">
								<tr>
									<th>S No</th>
									<th>From Employee</th>                                    
									<th>Date</th>
									<th>Receive Amount</th>
									<th>Given Amount</th>
									<th>Remark</th>
									
								</tr>
                            </thead>
                            
							<tbody>
								<?php

								$query=$db->query("(SELECT id, 
        (SELECT user_name 
         FROM   user_infromation 
         WHERE  user_id = frm_emp_id) AS emp_name, 
        amount                        AS receive, 
        0                             AS given, 
        send_date, 
        remark 
 FROM   recipt_master) 
UNION 
(SELECT id, 
        (SELECT user_name 
         FROM   user_infromation 
         WHERE  user_id = created_by) AS created_by, 
        0, 
        amount, 
        send_date, 
        remark 
 FROM   recipt_master)  ORDER BY  send_date asc ") or die(""); $i=0;
 
 $total_given=0;
 $total_receive=0;
 
			while($result=$query->fetch(PDO::FETCH_ASSOC)){ $i++;
								?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['emp_name']; ?>		
								</td>
								<td><?php echo $result['send_date']; ?></td>
								<td><?php echo $result['receive'];
									$total_receive=$total_receive+$result['receive'];
									
								?></td>
								
								<td><?php echo $result['given'];
										$total_given=$total_given+$result['given'];
								?></td>
								
								
								
								
								<td><?php echo $result['remark']; ?></td>
								
							</tr>
			<?php } ?>
			

				<a href="export_transcation_to_excel.php" style="color:blue;" ><b><u>Export to Excel</u></b></a>
		
                            </tbody>
                              
                        </table>

<br><br><br>
						
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
		window.location.replace("recived_amount_master.php?id="+cur_id);
	});

	
	  
</script>  
</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>