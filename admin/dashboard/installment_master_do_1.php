<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$login_id=$_COOKIE['login'];
	
	if(isset($_REQUEST['txt_frm_emp_id']) && isset($_REQUEST['txt_sel_date']) 
		&& isset($_REQUEST['txt_amnt']) && isset($_REQUEST['txt_remark'])){
			
		$txt_hide=str_replace("'","",$_REQUEST['txt_hide']);
		$txt_frm_emp_id=str_replace("'","",$_REQUEST['txt_frm_emp_id']);
		$txt_sel_date=str_replace("'","",$_REQUEST['txt_sel_date']);
		$txt_amnt=str_replace("'","",$_REQUEST['txt_amnt']);
		$txt_remark	=str_replace("'","",$_REQUEST['txt_remark']);

		
		$stud_tab_update=$db->query("UPDATE student_master_1 SET stud_paid_amnt=stud_paid_amnt+$txt_amnt,stud_balance=stud_balance-$txt_amnt
		WHERE id=$txt_frm_emp_id") or die("");
		
		if($txt_hide=="" || $txt_hide==null){
		$insQ=$db->query("insert into recipt_master_1(frm_emp_id ,send_date ,amount ,
		remark ,created_on ,created_by,reg_stud_id,pay_type) values(5,'$txt_sel_date',$txt_amnt,'$txt_remark',
		NOW(),$login_id,$txt_frm_emp_id,'instal')") or die("");
			

			$fetchQ=$db->query("SELECT id,stud_name,stud_email,stud_mo,stud_certificate_no,stud_paid_amnt,stud_balance,
			(SELECT c_title FROM course_master WHERE id=stud_course) AS stud_course,
stud_paid_amnt,stud_balance FROM student_master_1 WHERE id=$txt_frm_emp_id") or die("");
$fetchQ_res=$fetchQ->fetch(PDO::FETCH_ASSOC);

$txt_certificate=$fetchQ_res['stud_certificate_no'];
$txt_name=$fetchQ_res['stud_name'];
$txt_balance=$fetchQ_res['stud_balance'];


$fetchQ_1=$db->query("SELECT id,
			(SELECT c_fees FROM course_master WHERE id=stud_course) AS stud_course_fees,
stud_paid_amnt,stud_balance FROM student_master_1 WHERE id=$txt_frm_emp_id") or die("");
$fetchQ_res_1=$fetchQ_1->fetch(PDO::FETCH_ASSOC);



$recipt_id_q=$db->query("SELECT recipt_master_1.id as r_id,student_master_1.id,student_master_1.stud_name FROM `recipt_master_1`,student_master_1 where  recipt_master_1.reg_stud_id=$txt_frm_emp_id and  recipt_master_1.created_by=$login_id and student_master_1.id=recipt_master_1.reg_stud_id order by recipt_master_1.id desc limit 1") or die("");


$recipt_id_q_res=$recipt_id_q->fetch(PDO::FETCH_ASSOC);

$poid=$recipt_id_q_res['r_id'];

$recipt_id_q_1=$db->query("SELECT recipt_master_1.amount as r_amnt FROM `recipt_master_1`,student_master_1 where  recipt_master_1.reg_stud_id=$txt_frm_emp_id and  recipt_master_1.created_by=$login_id and student_master_1.id=recipt_master_1.reg_stud_id and recipt_master_1.id<$poid order by recipt_master_1.id desc limit 1") or die("");
$recipt_id_q_res_1=$recipt_id_q_1->fetch(PDO::FETCH_ASSOC);


//new start
$paid=$txt_amnt;

$prevBalAmnt=$paid+$txt_balance;

$message = '<html><body> <table rules="all" style="border-color: #333; width:100%;" border="1" cellpadding="10"> <tr style="padding:0px;"> <td colspan="2" align="center"><img src="http://www.sensible-computers.com/image/sens_logo.jpg" alt="" style="width:100%;"/></td> </tr> <tr style="background: #eee;"> <td>Head Office </td> <td>106, D-Block, Om-Parisar, Near Railway Station, Durg (C.G.)</td> </tr> <tr> <td>Branch Office </td> <td>Near Gupta Phataka, Junwani Road, Smriti Nagar, Bhilai (C.G.)</td> </tr> <tr style="background: #eee;"> <td>Contacts</td> <td>77228-99444, 0788-4011037</td> </tr> <tr> <td>Website </td> <td>www.sensible-computers.com</td> </tr> <tr style="background: #eee;"> <td>Receipt No</td> <td>'.$recipt_id_q_res['r_id'].'</td> </tr> <tr> <td>Recipt Date</td> <td>'.$txt_sel_date.'</td> </tr> <tr style="background: #eee;"> <td>Student Id</td> <td>'.$txt_certificate.'</td> </tr> <tr> <td>Student Name</td> <td>'.$txt_name.'</td> </tr> <tr style="background: #eee;"> <td>Course Name</td> <td>'.$fetchQ_res['stud_course'].'</td> </tr> <tr> <td>Course Fees</td> <td>'.$fetchQ_res_1['stud_course_fees'].' rs</td> </tr> <tr style="background: #eee;"> <td>Prev. Balance Amount</td> <td>'.$prevBalAmnt.' rs</td> </tr> <tr> <td>Recive Amount</td> <td>'.$paid.' rs</td> </tr> <tr style="background: #eee;"> <td>Cur. Balance Amount</td> <td>'.$txt_balance.' rs</td> </tr> </table> </body></html>';

$to1 ="prateekchandrakar485@gmail.com"; 	
	$subject1 = "Enquiry check in www.sensible-computers.com";	
	$message1 = $message;	
	$from1= "hr@sensible-computers.com";		
	$headers  = "From: $from1\r\n"; 	
	$headers .= "Content-type: text/html\r\n"; 		
	mail($to1,$subject1,$message1,$headers);
//new end





		?>
			<script>
				alert("Sucessfully Saved !..");
				window.location.replace("installment_master_1.php");
			</script>
		<?php
		
		}
		else{
			$insQ=$db->query("update recipt_master_1 set frm_emp_id =5,
			send_date ='$txt_sel_date',amount= $txt_amnt,
			remark ='$txt_remark',updated_by=$login_id,updated_on=NOW(),reg_stud_id=$txt_frm_emp_id,
			pay_type='instal' where id=$txt_hide") or die("");
			?>
				<script>
					alert("Sucessfully Updated !..");
					window.location.replace("employee_transcation_history.php");
				</script>
			<?php
		}
		
	}
	else{
	}		
}
else
{
	header("location:../index.php");	
}
?>