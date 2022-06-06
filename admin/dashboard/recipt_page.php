<?php if(isset($_COOKIE['login']))
{	
	require("../../root/db_connection.php");
	$id=str_replace("'","",$_REQUEST['id']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
   <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->
   
   
</head>

<body>
<style>
.outer_div{
	border  :1px solid #333; padding-top:10px; padding-bottom:10px;
}
.col-lg-5{
	width:100%;
}
</style>

<div class="container">
	<div class="row">	
		<div class="col-lg-5">
			<div class="outer_div">
				
				<div style="padding-left:10px; padding-right:10px; ">
				
				<div align="center" style="padding:10px;">
					<img src="images/recipt_img.jpg" style="border:1px solid #ccc; width:100%;" class="img-responsive" >
					
				</div>
				
				
					<div style="border:1px solid #ccc; padding:10px;">
					<table class="table table-responsive" style="margin:0px; font-size:15px;">
						<tr >
							<td style="width:25%;"><strong>H/ Office :  </strong> </td>
							<td style="width:75%;">106, D-Block, Om-Parisar, New Railway Station, Durg (C.G.)</td>
						</tr>
						<tr>
							<td>
							<strong>B/ Office :  </strong></td>
							<td>
								Near Gupta Phatak, Junwani Road, Smriti Nagar, Bhilai (C.G.)</td>
						</tr>
						<tr>
							<td>
					<strong>Mobile : </strong></td>
						<td>93013-51989, 77228-99444, 77228-66444</td>
						</tr>
						<tr>
							<td><strong>Website : </strong></td>
							<td>www.sensible-computers.com</td>
					</tr>
					</table>
					</div>
					<?php
$id=str_replace("'","",$_REQUEST['id']);
					$resQ=$db->query("SELECT id, 
       stud_name, 
       stud_add, 
       stud_mo, DATE_FORMAT(created_on,'%D %M %Y') as created_on,
       stud_branch, 
       stud_sem, 
	   stud_course as c_id,
       stud_clg_name, 
       (SELECT c_title 
        FROM   course_master 
        WHERE  id = stud_course) AS stud_course, 
       stud_fees, 
       stud_paid_amnt, 
       stud_balance ,stud_discount
FROM   student_master 
WHERE  flag = 'true' and id=$id ") or die("");
						$resQ_res=$resQ->fetch(PDO::FETCH_ASSOC);
						$c_id=$resQ_res['c_id'];
					?>
					<br>
					
					<div style="border:1px solid #ccc; padding:10px;">
					<table class="table table-responsive" style="margin:0px; width:100%;">
						<tr>
							<td style="width:30%;"><strong>Recipt No : </strong></td>
							<td style="width:70%;"><?php echo $resQ_res['id']; ?></td>
						</tr>
						
						<tr>
							<td><strong>Date : </strong></td>
							<td><?php echo $resQ_res['created_on']; ?></td>
						</tr>
						
						<tr>
							<td>
								<strong>Student Name : </strong> </td>
								<td><?php echo $resQ_res['stud_name']; ?></td>
						</tr>
						
						<tr>
							<td>
								<strong>Address : </strong></td>
									<td><?php echo $resQ_res['stud_add']; ?></td>
						</tr>
						
						<tr>
							<td>
								<strong>Mobile No : </strong></td>
									<td><?php echo $resQ_res['stud_mo']; ?></td>
						</tr>
						
						<tr>
							<td>
								<strong>Course Name : </strong></td>
									<td><?php echo $resQ_res['stud_course']; ?></td>
						</tr>
					</table>
					</div>
					
					
					<br>
					<div style="border:1px solid #ccc; padding:10px;">
					<table class="table table-responsive" style="margin:0px; width:100%;">
					<tr>
						<td style="width:40%;"><strong>Course Fees (Total) : </strong> </td>
						
						<?php  $c_feeQ=$db->query("SELECT c_fees FROM course_master WHERE id=$c_id") or die("");
							$c_feeQ_res=$c_feeQ->fetch(PDO::FETCH_ASSOC);
							$t_fee=$c_feeQ_res['c_fees'];
							
						?>
						<td style="width:60%;"><?php echo $c_feeQ_res['c_fees']; ?></td>
					</tr>
					<tr>
						<td><strong>Registration  Fee : </strong></td>
							<td><?php echo $resQ_res['stud_paid_amnt']; ?></td>
					</tr>
					<tr>
						<td><strong>Discount : </strong></td>
							<td><?php echo $resQ_res['stud_discount']; ?>%</td>
					</tr>
					<tr>
						<td><strong>Balance : </strong></td>
							<td><?php echo $resQ_res['stud_balance']; ?></td>
					</tr>
					
					<tr>
						<td><strong>Total : </strong></td>
							<td><?php echo $resQ_res['stud_balance']; ?></td>
					</tr>
					
					</table>
					
					<span style="float:right;">Signature </span>
					<div style="clear:both;"></div>
				</div>				
			</div>
			
		</div>
	</div>
</div>


</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>