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
						<h4 align="center"><strong>User Quiz Report</strong></h4><hr>
						
						
						 <ol class="breadcrumb">

                                   
                                    <li class="active">
                                        <a href="all_register_student_master.php"><i class="fa fa-dashboard"></i> All Register User</a>
                                    </li>

                                  <li class="active">
                                        <a href="student_quiz_report.php"><i class="fa fa-dashboard"></i> User Quiz Report</a>
                                    </li>
									
									
                                </ol>
					
					</div>	
						
       <style>
#count_loader{
	display:none;
}
</style>	   
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
					
			<label>Select Course/Exam to count total no Users : </label>
			<select id="count_id_sel" style="width:300px;">
				<option value="s_q_c">---select---</option>
				<?php
					$attQ=$db->query("SELECT id,q_title FROM quiz_maste WHERE flag='true' AND e_d_optn='true' ORDER BY id desc") or die("");
					while($attQ_Res=$attQ->fetch(PDO::FETCH_ASSOC)){
				?>
					<option value="<?php echo $attQ_Res['id']; ?>"><?php echo $attQ_Res['q_title']; ?></option>
					<?php } ?>
			</select>
			
			
			<span style="color:red; margin-left:20px; font-size:15px; font-weight:bold;" id="c_res"></span>
			
<br>			
	<p align="center">
		<img src="loading2.gif" id="count_loader" style="width:40px;  margin-top:10px;">
	</p>
 <br>
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
									<th>User Name</th>
                                    <th>Quiz Title</th>
									 <th>Total Que</th>
									<th>Time</th>
									<th>Right</th>
                                    <th>Wrong</th>
                                </tr>
                            </thead>
                            <tbody id="filter_Res">
							<?php $n_q=$db->query("SELECT id, 
       stud_id,(SELECT stud_name FROM student_master WHERE id=stud_id) AS stud_name,  
       quiz_id, 
       (SELECT q_title 
        FROM   quiz_maste 
        WHERE  id = quiz_id)               AS quiz_title, 
       quiz_right_ans, 
       quiz_wrong_ans, 
       quiz_blank_ans, 
       quiz_time_spend, 
       quiz_count, 
       que_count, 
	   (SELECT q_totl_time FROM quiz_maste WHERE id=quiz_id) quiz_total_time,
       Date_format(created_on, '%D %M %Y') AS created_on 
FROM   quiz_res_detail 
WHERE  flag = 'true' 
ORDER  BY id DESC ") or die(""); $i=0;

$totalQuiz=$n_q->rowCount();

								while($n_q_res=$n_q->fetch(PDO::FETCH_ASSOC)){ $i++;
 ?>
			
				<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $n_q_res['stud_name']; ?></td>
					<td><?php echo $n_q_res['quiz_title']; ?><sub>
						<span style="color:blue;"><?php echo $n_q_res['created_on']; ?></span></sub></td>
					<td><?php echo $n_q_res['que_count']; ?> Que</td>
					<td><?php echo $n_q_res['quiz_total_time']; ?>/
						<?php echo $n_q_res['quiz_time_spend']; ?>
					<sub>min</sub></td>
					<td><?php echo $n_q_res['quiz_right_ans']; ?><sub>
						<span style="color:green;">Correct</span>
							</sub></td>
					<td><?php echo $n_q_res['quiz_wrong_ans']; ?><sub>
						<span style="color:red;">Incorrect</span></sub></td>
					
					
				</tr>
	<?php } ?>        
                            </tbody>
							
							<b><u>Total Quiz Attempted by User :</b> <?php echo $totalQuiz; ?></u>
							
							
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
	  
	  
$("#count_id_sel").on("change",function(e){
	if($("#count_id_sel option:selected").val()=="s_q_c"){
		alert("Please Select Course/Exam !...");
	}
	else{
		var cur_id=$("#count_id_sel option:selected").val();
		$("#count_loader").css("display","block");
		$.ajax({
			type:"POST",
			url:"fetch_quiz_report_user_count.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				$("#c_res").html(r_data);	
				$("#count_loader").css("display","none");				
			},error:function(err){
				location.reload();
			}
		});
	}
});
</script>
<!---start modal--->
</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>