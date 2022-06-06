<?php
if(isset($_COOKIE['login']))
{
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


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">



    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



        
        
</head>

<body>
<style>
#amnt_res{
	font-weight:600;
	float:right;
}
</style>
    <div id="wrapper">

        <!-- Navigation -->
        <?php
        include("header.php");
        
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h4 align="center" class="page-header">
                            <b>Installment Master</b>
                        </h4>

						
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
						
						
                    </div>
                    
					<div class="col-lg-3"></div>
                    <div class="col-lg-6">
                     <?php if(isset($_REQUEST['id'])){						 
					 
						 $id=$_REQUEST['id'];		 
						 
			$editQ=$db->query("SELECT id,reg_stud_id ,send_date ,recive_date ,amount ,remark 
			FROM recipt_master_1 WHERE flag='true' AND id=$id ORDER BY id desc") or die("");	

			$edit_q_res=$editQ->fetch(PDO::FETCH_ASSOC);
			
						 ?>
						  <form role="form" name="" id="txtFrm" method="post" enctype="multipart/form-data"  action="installment_master_do_1.php">
                        
                        <label>From Student</label>
						
						<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $edit_q_res['id'] ?>">
						
						<select name="txt_frm_emp_id" id="txt_frm_emp_id" class="form-control">
							
							<?php
							$empQ=$db->query("SELECT id,stud_name FROM student_master_1 ORDER BY id desc") or die("");
							while($empQ_res=$empQ->fetch(PDO::FETCH_ASSOC)){
								if($empQ_res['id']==$edit_q_res['reg_stud_id']){
									?>
									<option selected value="<?php echo $empQ_res['id']; ?>">
								<?php echo $empQ_res['stud_name']."-".$empQ_res['stud_certificate_no']; ?>
							</option>
									<?php
								}
								else{
							?>
							<option value="<?php echo $empQ_res['id']; ?>">
								<?php echo $empQ_res['stud_name']."-".$empQ_res['stud_certificate_no']; ?>
							</option>
								<?php } ?>
							<?php } ?>
							
						</select>
						
						<span id="amnt_res"></span>
						
						<br>
						
						<label>Select Date </label>
						
						<input  value="<?php echo $edit_q_res['send_date']; ?>" type="date" class="form-control" name="txt_sel_date" id="txt_sel_date">
						
						<br>
					
						<label>Amount</label>
						<input value="<?php echo $edit_q_res['amount']; ?>" type="number" class="form-control" name="txt_amnt" id="txt_amnt">
                               <br>
							   
						<label>Remark</label>
							<textarea rows="4" class="form-control" name="txt_remark" id="txt_remark"><?php echo $edit_q_res['remark']; ?></textarea>
							
							
<br>						

<button class="btn btn-sm btn-success btn_submit" type="button" disabled>Submit</button>
                        </form>
						 <?php

					 }
else{					 ?>   
                        <form role="form" name="" id="txtFrm" method="post" enctype="multipart/form-data"  action="installment_master_do_1.php">
                        
                        <label>From Student</label>
						
						<input type="hidden" name="txt_hide" id="txt_hide">
						
						<select name="txt_frm_emp_id" id="txt_frm_emp_id" class="form-control">
							<option value="s_e">
								---Select Student---
							</option>
							
							<?php
							$empQ=$db->query("SELECT id,stud_name,stud_certificate_no FROM student_master_1 ORDER BY stud_name ASC") or die("");
							while($empQ_res=$empQ->fetch(PDO::FETCH_ASSOC)){
								
							?>
							<option value="<?php echo $empQ_res['id']; ?>">
								<?php echo $empQ_res['stud_name']."-".$empQ_res['stud_certificate_no']; ?>
							</option>
							<?php } ?>
							
						</select>
						<span id="amnt_res"></span>
						<br>
						
						<label>Select Date </label>
						
						<input type="date" class="form-control" name="txt_sel_date" id="txt_sel_date">
						
						<br>
					
						<label>Amount</label>
						<input type="number" class="form-control" name="txt_amnt" id="txt_amnt">
                               <br>
							   
						<label>Remark</label>
							<textarea rows="4" class="form-control" name="txt_remark" id="txt_remark"></textarea>
							
							
<br>						

<button class="btn btn-sm btn-success btn_submit" type="button" >Submit</button>
                        </form>
<?php } ?>    
                    </div>
                    <div class="col-lg-3"></div>
                </div>
             
               <br><br>  
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

  
<script>
$(".btn_submit").on("click",function(e){
	if($("#txt_frm_emp_id option:selected").val()=="s_e"){
		alert("Please Select Student !...");
		$("#txt_frm_emp_id").focus();
	}
	else if($("#txt_sel_date").val()=="" || $("#txt_sel_date").val()==null){
		$("#txt_sel_date").focus();
	}
	else if($("#txt_amnt").val()=="" || $("#txt_amnt").val()==null){
		$("#txt_amnt").focus();
	}
	else if($("#txt_remark").val()=="" || $("#txt_remark").val()==null){
		$("#txt_remark").focus();
	}
	else {
	    $(".btn_submit").prop('disabled',true)
		$("#txtFrm").submit();
	}	
});


$("#txt_frm_emp_id").on("change",function(e){
	if($("#txt_frm_emp_id option:selected").val()=="s_e"){
		alert("please select Student !...");
		$("#txt_frm_emp_id").focus();
	}
	else{
		var cur_id=$("#txt_frm_emp_id option:selected").val();
		//alert(cur_id);
		$.ajax({
			type:"POST",
			url:"base_library_1.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				$("#amnt_res").html(r_data);
				//alert(r_data);
				//location.reload();
			},error:function(err){
			location.reload();
			}
		});		
	}
	
});

</script>  

</body>

</html>
<?php
}

else
{

	header("location:../index.php");	
}

?>

