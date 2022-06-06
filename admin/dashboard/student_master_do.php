<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	if(isset($_REQUEST['txt_name']) && isset($_REQUEST['txt_address']) &&   
	isset($_REQUEST['txt_branch'])  &&   isset($_REQUEST['txt_mobile']) &&  
	isset($_REQUEST['txt_sem'])&&   isset($_REQUEST['txt_certificate'])&&   
	isset($_REQUEST['txt_total'])&&   isset($_REQUEST['txt_paid']) &&   
	isset($_REQUEST['txt_clg'])&&   isset($_REQUEST['txt_discount'])&&   
	isset($_REQUEST['txt_balance'])){
		$txt_name=str_replace("'","",$_REQUEST['txt_name']);
		$txt_address=str_replace("'","",$_REQUEST['txt_address']);		
		$txt_branch=str_replace("'","",$_REQUEST['txt_branch']);	
		$sel_receipt=str_replace("'","",$_REQUEST['sel_receipt']);		
		$sel_course=str_replace("'","",$_REQUEST['sel_course']);		
		$txt_email=str_replace("'","",$_REQUEST['txt_email']);		
		$txt_mobile=str_replace("'","",$_REQUEST['txt_mobile']);		
		$txt_sem=str_replace("'","",$_REQUEST['txt_sem']);		
		$txt_certificate=str_replace("'","",$_REQUEST['txt_certificate']);		
		$txt_total=str_replace("'","",$_REQUEST['txt_total']);		
		$txt_paid=str_replace("'","",$_REQUEST['txt_paid']);		
		$txt_clg=str_replace("'","",$_REQUEST['txt_clg']);		
		$txt_discount=str_replace("'","",$_REQUEST['txt_discount']);		
		$txt_balance=str_replace("'","",$_REQUEST['txt_balance']);	
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);


$txt_frm_date=str_replace("'","",$_REQUEST['txt_frm_date']);
$txt_to_date=str_replace("'","",$_REQUEST['txt_to_date']);

$current_date=date("Y/m/d");


		
				if($txt_hide=="" || $txt_hide==NULL){		
					
					$insQ=$db->query("INSERT INTO student_master(stud_name,stud_email,stud_add,stud_mo,stud_branch,stud_sem,stud_clg_name,stud_course,stud_fees,
					stud_paid_amnt,stud_discount,stud_balance,stud_recipt_optn,stud_certificate_no,created_by,
					created_on,certi_frm_date,certi_to_date) 
					VALUES('$txt_name','$txt_email','$txt_address','$txt_mobile','$txt_branch',
'$txt_sem','$txt_clg','$sel_course','$txt_total','$txt_paid','$txt_discount','$txt_balance','$sel_receipt','$txt_certificate',$login_id,NOW(),
'$txt_frm_date','$txt_to_date')") or die("");


				$user_id = $db->lastInsertId();
							
				
				
				
$insQ=$db->query("insert into recipt_master(reg_stud_id,frm_emp_id ,send_date ,amount ,
		remark ,created_on ,created_by) values($user_id,5,NOW(),$txt_paid,'$txt_certificate',
		NOW(),$login_id)") or die("");

$lastReciptId	= $db->lastInsertId();	

$c_q=$db->query("SELECT c_title,c_fees FROM course_master WHERE id=$sel_course") or die("");
$c_q_res=$c_q->fetch(PDO::FETCH_ASSOC);
				
				
				
				

/*email----*/

//new start
$paid=$txt_balance+$txt_paid;
$message = '<html><body> <table rules="all" style="border-color: #333; width:100%;" border="1" cellpadding="10"> <tr style="padding:0px;"> <td colspan="2" align="center"><img src="http://www.sensible-computers.com/image/sens_logo.jpg" alt="" style="width:100%;"/></td> </tr> <tr style="background: #eee;"> <td>Head Office </td> <td>106, D-Block, Om-Parisar, Near Railway Station, Durg (C.G.)</td> </tr> <tr> <td>Branch Office </td> <td>Near Gupta Phataka, Junwani Road, Smriti Nagar, Bhilai (C.G.)</td> </tr> <tr style="background: #eee;"> <td>Contacts</td> <td>77228-99444, 0788-4011037</td> </tr> <tr> <td>Website </td> <td>www.sensible-computers.com</td> </tr> <tr style="background: #eee;"> <td>Receipt No</td> <td>'.$lastReciptId.'</td> </tr> <tr> <td>Recipt Date</td> <td>'.$current_date.'</td> </tr> <tr style="background: #eee;"> <td>Student Id</td> <td>'.$txt_certificate.'</td> </tr> <tr> <td>Student Name</td> <td>'.$txt_name.'</td> </tr> <tr style="background: #eee;"> <td>Course Name</td> <td>'.$c_q_res['c_title'].'</td> </tr> <tr> <td>Course Fees</td> <td>'.$c_q_res['c_fees'].' rs</td> </tr> <tr style="background: #eee;"> <td>Prev. Balance Amount</td> <td>'.$paid.' rs</td> </tr> <tr> <td>Recive Amount</td> <td>'.$txt_paid.' rs</td> </tr> <tr style="background: #eee;"> <td>Cur. Balance Amount</td> <td>'.$txt_balance.' rs</td> </tr> </table> </body></html>';

$to1 =$txt_email; 	
	$subject1 = "Receipt from Sensible Computers";	
	$message1 = $message;	
	$from1= "hr@sensible-computers.com";		
	$headers  = "From: $from1\r\n"; 	
	$headers .= "Content-type: text/html\r\n"; 		
	mail($to1,$subject1,$message1,$headers);
//new end

/*---end email---*/
					?>
			<script>
				alert("Sucessfully Added !...");
				window.location.replace("student_master.php");
			</script>
					<?php
				}
				else{				
						$updateQ=$db->query("UPDATE student_master SET stud_name='$txt_name',
							stud_email='$txt_email',stud_add='$txt_address',stud_mo='$txt_mobile',
								stud_branch='$txt_branch',stud_sem='$txt_sem',stud_clg_name='$txt_clg',
									stud_course='$sel_course',stud_fees='$txt_total',stud_paid_amnt='$txt_paid',
										stud_discount='$txt_discount',stud_balance='$txt_balance',
										stud_recipt_optn='$sel_receipt',stud_certificate_no='$txt_certificate',
										updated_by=$login_id ,updated_on=NOW(),
certi_frm_date='$txt_frm_date',certi_to_date='$txt_to_date'
										where id=$txt_hide") or die("");	


$c_q=$db->query("SELECT c_title,c_fees FROM course_master WHERE id=$sel_course") or die("");
$c_q_res=$c_q->fetch(PDO::FETCH_ASSOC);


$recipt_id_q=$db->query("SELECT recipt_master.id as r_id,recipt_master.amount as r_amnt,recipt_master.pay_type,student_master.id,student_master.stud_name FROM `recipt_master`,student_master where  recipt_master.reg_stud_id=$txt_hide and  recipt_master.created_by=$login_id and student_master.id=recipt_master.reg_stud_id order by recipt_master.id desc limit 1") or die("");

$recipt_id_q_res=$recipt_id_q->fetch(PDO::FETCH_ASSOC);

		/*email----*/
//new start
$paid=$txt_balance+$txt_paid;
$message = '<html><body> <table rules="all" style="border-color: #333; width:100%;" border="1" cellpadding="10"> <tr style="padding:0px;"> <td colspan="2" align="center"><img src="http://www.sensible-computers.com/image/sens_logo.jpg" alt="" style="width:100%;"/></td> </tr> <tr style="background: #eee;"> <td>Head Office </td> <td>106, D-Block, Om-Parisar, Near Railway Station, Durg (C.G.)</td> </tr> <tr> <td>Branch Office </td> <td>Near Gupta Phataka, Junwani Road, Smriti Nagar, Bhilai (C.G.)</td> </tr> <tr style="background: #eee;"> <td>Contacts</td> <td>77228-99444, 0788-4011037</td> </tr> <tr> <td>Website </td> <td>www.sensible-computers.com</td> </tr> <tr style="background: #eee;"> <td>Receipt No</td> <td>'.$recipt_id_q_res['r_id'].'</td> </tr> <tr> <td>Recipt Date</td> <td>'.$current_date.'</td> </tr> <tr style="background: #eee;"> <td>Student Id</td> <td>'.$txt_certificate.'</td> </tr> <tr> <td>Student Name</td> <td>'.$txt_name.'</td> </tr> <tr style="background: #eee;"> <td>Course Name</td> <td>'.$c_q_res['c_title'].'</td> </tr> <tr> <td>Course Fees</td> <td>'.$c_q_res['c_fees'].' rs</td> </tr> <tr style="background: #eee;"> <td>Prev. Balance Amount</td> <td>'.$recipt_id_q_res['r_amnt'].' rs</td> </tr> <tr> <td>Recive Amount</td> <td>'.$txt_paid.' rs</td> </tr> <tr style="background: #eee;"> <td>Cur. Balance Amount</td> <td>'.$txt_balance.' rs</td> </tr> </table> </body></html>';

$to1 =$txt_email; 	
	$subject1 = "Receipt from Sensible Computers";	
	$message1 = $message;	
	$from1= "hr@sensible-computers.com";		
	$headers  = "From: $from1\r\n"; 	
	$headers .= "Content-type: text/html\r\n"; 		
	mail($to1,$subject1,$message1,$headers);
//new end




/*---end email---*/

			
/*$insQ=$db->query("update recipt_master_1 set amount='$txt_paid',updated_on=NOW() ,updated_by=$login_id 
 where reg_stud_id=$txt_hide") or die("");
		
	*/	

		
					
					?>
					<script>
				alert("Sucessfully Updated !...");
		window.location.replace("manage_student_master.php");
			</script>
					<?php
				}	
	}
	else{
		?>
			<script>
				alert("Try Again !...");
			window.location.replace("student_master.php");
			</script>
				<?php
	}		
}
else{
	header("location:../index.php");	
}
?>