<?php
	if(isset($_COOKIE['login'])){

		$login_id= $_COOKIE['login'];
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
    </head>
    <body>
        <div id="wrapper">
            <?php  include("header.php");  ?>
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 align="center"><strong>Student Master</strong></h4>
                                <hr>

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

<?php if(isset($_REQUEST['id'])){
	$id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("SELECT id,certi_to_date,certi_frm_date,stud_name,stud_add,stud_email,stud_mo,stud_branch,stud_sem,stud_clg_name,stud_course,stud_fees,stud_paid_amnt,stud_discount,stud_balance,stud_recipt_optn,stud_certificate_no FROM student_master_1 where id=$id and flag='true'") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<form name="" method="post" enctype="multipart/form-data" action="student_master_do_1.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Student Name</label>
                                    <input value="<?php echo $editQ_res['stud_name']; ?>" id="txt_name"  name="txt_name" type="text" class="form-control" placeholder="Name *">
									<input type="hidden" name="txt_hide" value="<?php echo $editQ_res['id']; ?>" id="txt_hide">
                                    <br>
                                </div>

									<div class="col-lg-6">
                                    <label>Student Address</label>
									<input type="text" id="txt_address"  name="txt_address"  class="form-control" placeholder="Address *" value="<?php echo $editQ_res['stud_add']; ?>">
                                    <br>
                                    </div>
                                    <div class="col-lg-6">
                                    <label>Mobile No</label>
									 <input value="<?php echo $editQ_res['stud_mo']; ?>" type="number" name="txt_mobile" id="txt_mobile" class="form-control" placeholder="Mobile No. *">
                        <br>
                                    </div>
                                    
								
							 <div class="col-lg-6">
                                    <label>Email Address</label>
									 <input value="<?php echo $editQ_res['stud_email']; ?>" type="text" name="txt_email" id="txt_email" class="form-control" placeholder="Email Address *">
                        <br>
                                    </div>
                                    

									
								
                                <div class="col-lg-6">

                                  <label>Branch</label>
                                     <input value="<?php echo $editQ_res['stud_branch']; ?>" id="txt_branch"  name="txt_branch" type="text" class="form-control" placeholder="Branch *">

                                    <br>
                                </div>
                                 <div class="col-lg-6">

                                  <label>Sem</label>
                                     <input value="<?php echo $editQ_res['stud_sem']; ?>" id="txt_sem"  name="txt_sem" type="text" class="form-control" placeholder="Sem *">

                                    <br>
                                </div>
                                 <div class="col-lg-6">

                                  <label>College Name</label>
                                     <input value="<?php echo $editQ_res['stud_clg_name']; ?>" id="txt_clg"  name="txt_clg" type="text" class="form-control" placeholder="College Name *">

                                    
                                </div>
                                <div class="col-lg-6">
							
                                  <label>Select Course</label>
                                  <select class="form-control"  name="sel_course" id="sel_course">
                                  <option value="s_o">Select Option</option>

                                  <?php $query=$db->query("SELECT id,c_title from course_master ORDER BY id desc") or die("");
	while($result=$query->fetch(PDO::FETCH_ASSOC)){
		
		if($editQ_res['stud_course']==$result['id']){
			?>
            <option  selected value="<?php echo $result['id']; ?>"><?php echo $result['c_title'];?></option>
            <?php
		}
		else{
		 ?>
                                  <option  value="<?php echo $result['id']; ?>"><?php echo $result['c_title'];?></option>
                                  <?php } } ?>
                                  </select>
                                  
								  
								  
                                  </div>
								  
								  
								  <div class="col-lg-6">
<br>
<label> &nbsp;Receipt</label>
<select class="form-control" name="sel_receipt" id="sel_receipt">
<option value="n">No</option>

<option value="y">Yes</option>

</select>
</div>


                                   <div class="col-lg-2">
<br>
                                  <label>Certificate No</label>
                                     <input value="<?php echo $editQ_res['stud_certificate_no']; ?>" id="txt_certificate"  name="txt_certificate" type="text" class="form-control" placeholder="Cerificate *">

                                    <br>
                                </div>
								
								<div class="col-lg-2">
								<br>
                                  <label>From</label>
								  <input type="date" value="<?php echo $editQ_res['certi_frm_date']; ?>" class="form-control" id="txt_frm_date" name="txt_frm_date">
								</div>
								
								<div class="col-lg-2">
								<br>
                                  <label>To</label>
								   <input type="date" value="<?php echo $editQ_res['certi_to_date']; ?>" class="form-control" id="txt_to_date" name="txt_to_date">
								</div>
								
								<div class="col-lg-12"></div>
								
                                <div class="col-lg-3">

                                  <label>Total Fess</label>
                                   <input readonly value="<?php echo $editQ_res['stud_fees']; ?>" id="txt_total"  name="txt_total" type="text" class="form-control" placeholder="Total Fees *">
                                  </div>
                                  <div class="col-lg-3">

                                  <label>Discount</label>
                                   <input value="<?php echo $editQ_res['stud_discount']; ?>"    id="txt_discount"  name="txt_discount" type="text" class="form-control" placeholder="Discount *">
                                  </div>
                                  <div class="col-lg-3">

                                  <label>Paid</label>
                                   <input value="<?php echo $editQ_res['stud_paid_amnt']; ?>" id="txt_paid"  name="txt_paid" type="text" class="form-control" placeholder="Paid *">
                                  </div>
                                   <div class="col-lg-3">

                                  <label>Balance</label>
                                   <input value="<?php echo $editQ_res['stud_balance']; ?>" id="txt_balance"  name="txt_balance" type="text" class="form-control" placeholder="Balance *">
                                  </div>
                               

        

                                <div class="col-lg-12">
<br>
             <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                </div>


                            </form>
<?php

	} else {  ?>
	<form name="" method="post" enctype="multipart/form-data" action="student_master_do_1.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Student Name</label>
                                    <input value="" id="txt_name"  name="txt_name" type="text" class="form-control" placeholder="Name *">
									<input type="hidden" name="txt_hide" value="" id="txt_hide">
                                    <br>
                                </div>

									<div class="col-lg-6">
                                    <label>Student Address</label>
									<input type="text" id="txt_address"  name="txt_address"  class="form-control" placeholder="Address *">
                                    <br>
                                    </div>
                                    <div class="col-lg-6">
                                    <label>Mobile No</label>
									 <input value="" type="number" name="txt_mobile" id="txt_mobile" class="form-control" placeholder="Mobile No. *">
                        <br>
                                    </div>
									
									
									 <div class="col-lg-6">
                                    <label>Email Address</label>
									 <input value="" type="text" name="txt_email" id="txt_email" class="form-control" placeholder="Email Address *">
                        <br>
                                    </div>
                                    
								
								
								
                                <div class="col-lg-6">

                                  <label>Branch</label>
                                     <input value="" id="txt_branch"  name="txt_branch" type="text" class="form-control" placeholder="Branch *">

                                    <br>
                                </div>
                                 <div class="col-lg-6">

                                  <label>Sem</label>
                                     <input value="" id="txt_sem"  name="txt_sem" type="text" class="form-control" placeholder="Sem *">

                                    <br>
                                </div>
                                 <div class="col-lg-6">

                                  <label>College Name</label>
                                     <input value="" id="txt_clg"  name="txt_clg" type="text" class="form-control" placeholder="College Name *">

                                    
                                </div>
                                <div class="col-lg-6">
							
                                  <label>Select Course</label>
                                  <select class="form-control" name="sel_course" id="sel_course">
                                  <option value="s_o">Select Option</option>

                                  <?php $query=$db->query("SELECT id,c_title from course_master ORDER BY id desc") or die("");
	while($result=$query->fetch(PDO::FETCH_ASSOC)){ ?>
                                  <option value="<?php echo $result['id'];?>"><?php echo $result['c_title'];?></option>
                                  <?php } ?>
                                  </select>
                                  
                                  </div>
								  
								  
								  <div class="col-lg-6">
<br>
<label> &nbsp;Receipt</label>
<select class="form-control" name="sel_receipt" id="sel_receipt">
<option value="n">No</option>

<option value="y">Yes</option>

</select><br>
</div>
         
		 
		 
		 
                                   <div class="col-lg-2">
<br>
                                  <label>Certificate No</label>
								  <?php $certiQ=$db->query("SELECT MAX(stud_certificate_no)+1 AS certi_no FROM student_master") or die("");
									$certiQ_res=$certiQ->fetch(PDO::FETCH_ASSOC);
								  ?>
                                     <input value="<?php echo $certiQ_res['certi_no']; ?>" id="txt_certificate"  name="txt_certificate" type="text" class="form-control" placeholder="Cerificate *">

                                    <br>
                                </div>
								
								<div class="col-lg-2">
								<br>
                                  <label>From</label>
								  <input type="date" class="form-control" id="txt_frm_date" name="txt_frm_date">
								</div>
								
								<div class="col-lg-2">
								<br>
                                  <label>To</label>
								   <input type="date" class="form-control" id="txt_to_date" name="txt_to_date">
								</div>
								
								
								<div class="col-lg-12"></div>
                                <div class="col-lg-3">

                                  <label>Total Fess</label>
                                   <input  id="txt_total"    name="txt_total" type="text" class="form-control" placeholder="Total Fees *">
                                  </div>
                                  <div class="col-lg-3">

                                  <label>Discount</label>
                                   <input  id="txt_discount"  name="txt_discount" value="0" type="text" class="form-control" placeholder="Discount *">
                                  </div>
                                  <div class="col-lg-3">

                                  <label>Paid</label>
                                   <input value="" id="txt_paid"  name="txt_paid" type="text" class="form-control" placeholder="Paid *">
                                  </div>
                                   <div class="col-lg-3">

                                  <label>Balance</label>
                                   <input value="" id="txt_balance"  name="txt_balance" type="text" class="form-control" placeholder="Balance *">
                                  </div>
                               
                       

                                <div class="col-lg-12">
<br>
             <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                </div>

                            </form>
<?php } ?>
                           
                            <!---end--->
                        </div>

                    </div>
                </div>
        </div>
<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script>
$(".btn_submit").on("click",function(e){
	/*txt_test_title
txt_hide
txt_sel_parent
txt_image  
txt_priority 
txt_keyword 
txt_short_descp  
txt_description  
 */
	if($("#txt_name").val()=="" || $("#txt_name").val()==null){
		$("#txt_name").focus();
	}
	else if($("#txt_address").val()=="" || $("#txt_address").val()==null){
			$("#txt_address").focus();
	}
	else if($("#txt_mobile").val()=="" || $("#txt_mobile").val()==null){
			$("#txt_mobile").focus();
	}
	else if($("#txt_branch").val()=="" || $("#txt_branch").val()==null){
			$("#txt_branch").focus();
	}
	else{
		$(".btn_submit").prop("disabled",true);
				$("#txt_form").submit();
	}

});	


$("#sel_course").on("change",function(e){
	if($("#sel_course option:selected").val()=="s_o"){
		alert("Please Select Course !...");
		$("#sel_course").focus();
	}
	else{
		var cur_val=$("#sel_course option:selected").val();
		//alert(cur_val);
		$("#txt_paid").val('');
		$.ajax({
			type:"POST",
			url:"fetch_course_fees.php",
			data:{cur_val:cur_val},
			success:function(r_data){
				$("#txt_total").val(r_data);
			},error:function(err){
				alert("Try Again !...");
				location.reload();
			}
		});
	}
});


$("#txt_paid").on("keyup",function(e){	
	if($("#txt_total").val()=="" || $("#txt_total").val()==null){
		alert("Please Select Course !....");
	}
	else{
		var totla_amnt=$("#txt_total").val();		
		var paid_amnt=$("#txt_paid").val();

		var total_discount=$("#txt_discount").val();
		var total_amnt=$("#txt_total").val();
		var bal_amnt=total_amnt-(total_amnt*total_discount)/100-paid_amnt;
	
		
		
		//console.log(bal_amnt);
		$("#txt_balance").val(bal_amnt);
		/*total_discount=parseInt(total_discount);
		
		var bal=$("#txt_balance").val();
		var final_balance=bal-bal*-paid_amnt;
		$("#txt_balance").val(final_balance);*/
	}
});


$("#txt_discount").on("keyup",function(e){	
	var dis_val=$(this).val();
	//alert(dis_val);
	var paid_amnt=$("#txt_paid").val();
	var total_amnt=$("#txt_total").val();
	var total_dis=total_amnt-(total_amnt*dis_val)/100-paid_amnt;
	//alert(total_dis);
	$("#txt_balance").val(total_dis);
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