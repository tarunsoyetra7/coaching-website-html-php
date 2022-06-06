<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	$id=str_replace("'","",$_REQUEST['id']);
		
	$fetchQ=$db->query("SELECT total_present_stud, 
       stud_pro_file, 
       class_start_date, 
       class_end_date, 
       final_exm_date, 
       stud_data_frm, 
       stud_attan_sheet, 
       pay_descp, 
       t_c_name, 
       o_c_n_id, 
       t_cmp_add, 
       o_c_n_name, 
       ass_fee_detail, 
       o_f_name, 
       o_l_name, 
       o_m_no, 
       o_email_id, 
       instruct_trainner_detail 
FROM   center_info_master 
WHERE  id = $id
       AND flag = 'true' ") or die("");
		
	$fetchQ_res=$fetchQ->fetch(PDO::FETCH_ASSOC);	
	$courseID=$fetchQ_res['o_c_n_id'];	
?>

<tr>
    <th>Center Detail</th>
    <td><span id="tc_name">
          	<strong>Name : </strong><?php echo $fetchQ_res['t_c_name']; ?><br>
                        <strong>Address : </strong><?php echo $fetchQ_res['t_cmp_add']; ?><br>
                        <strong>Trade : </strong><?php echo $fetchQ_res['o_c_n_name']; ?>

                    </span></td>
</tr>

<tr>
    <th>Total Students</th>
    <td>
    <?php $totalStudQ=$db->query("SELECT COUNT(id) as totalStud FROM student_master WHERE flag='true' AND institut_id=$id") or die("");
	
	$totalStudQ_res=$totalStudQ->fetch(PDO::FETCH_ASSOC);
	 ?>
    <span id="tc_total_stud"><?php echo $totalStudQ_res['totalStud']; ?></span></td>
</tr>


<?php
$coursePaymentQ=$db->query("SELECT SUM(c_ass_fee) AS c_ass_fee,SUM(c_payout) c_payout FROM course_master WHERE FIND_IN_SET(id,'$courseID') AND flag='true'") or die("");


$coursePaymentQ_res=$coursePaymentQ->fetch(PDO::FETCH_ASSOC);

?>

<tr>
    <th>Assessment Fee Payment Details</th>
    <td><span id="tc_ass_fees"><?php echo $fetchQ_res['ass_fee_detail']; ?></span></td>
</tr>


<?php $detailQ=$db->query("SELECT cls_start_date,cls_end_date,exm_date,project_file,stud_data_frm,stud_vari_sheet,stud_atten_sheet,present_stud,ass_fee_detail,payment_descp FROM  detail_aftr_reg WHERE institute_id=$id AND flag='true'") or die("");
	$detailQ_res=$detailQ->fetch(PDO::FETCH_ASSOC);
 ?>


<tr>
    <th>Payment Description</th>
    <td><span id="tc_pay_descp"><?php echo $fetchQ_res['pay_descp']; ?></span></td>
</tr>

<tr>
    <th>Payout per students</th>
    <td><span id="tc_pay_descp"><?php echo $coursePaymentQ_res['c_payout']; ?></span></td>
</tr>

<tr>
    <th>Owner Detail : </th>
    <td><span id="tc_pay_descp">
                    	<strong>Name : </strong> <?php echo $fetchQ_res['o_f_name']." ".$fetchQ_res['o_l_name']; ?><br>
                        <strong>Contact No : <?php echo $fetchQ_res['o_m_no']; ?></strong><br>
                        <strong>Email Address : <?php echo $fetchQ_res['o_email_id']; ?></strong>

                    </span></td>
</tr>

<tr>
    <th>Trainners Detail</th>
    <td><span id="tc_pay_descp">
                    	<?php echo $fetchQ_res['instruct_trainner_detail']; ?>

                    </span></td>
</tr>

<tr>
    <th>Student Data Form</th>
    <td><span id="tc_pay_descp"><?php echo $fetchQ_res['stud_data_frm']; ?></span></td>
</tr>


<tr>
    <th>Student Attandance Sheet</th>
    <td><span id="tc_pay_descp"><?php echo $fetchQ_res['stud_attan_sheet']; ?></span></td>
</tr>




<tr>
    <th>Date</th>
    <td><span id="tc_pay_descp">
					
                    <strong>Class Start Date : </strong><?php echo $fetchQ_res['class_start_date']; ?>
                    
                    
                    
                    
                    <br>
                    <strong>Class End Date : </strong><?php echo $fetchQ_res['class_end_date']; ?><br>
                    <strong>Final Exam Date : </strong><?php echo $fetchQ_res['final_exm_date']; ?>

                    </span></td>
</tr>

<tr>
    <th>Project File</th>
    <td><span id="tc_pay_descp"><?php echo $fetchQ_res['stud_pro_file']; ?></span></td>
</tr>



<tr>
    <th>Total no of present student's</th>
    <td><span id="tc_pay_descp"><?php echo $fetchQ_res['total_present_stud']; ?></span></td>
</tr>
    	
    <?php	
		
		
}
else
{
	header("location:../index.php");	
}
?>