<?php if(isset($_COOKIE['login']))
{	
	require("../../root/db_connection.php");
	
?>
<?php
$filename = "Webinfopen.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
			<thead>
				<tr>
					<th>S No</th>
					<th>Certificate No</th>
					<th>Student Name</th>
					<th>Email</th>
					<th>Student Address</th>
					<th>Mobile No</th>
					<th>Collage Name</th>
					<th>Branch</th>
					<th>Semester</th>
					<th>Course</th>
					<th>Course Fees</th>
					<th>Paid Amount</th>
					<th>Discount</th>
					<th>Balance</th>					
				</tr>
			</thead>
			<tbody>
<?php
$user_query = $db->query("SELECT 
id,stud_name,stud_add,stud_mo,stud_branch,stud_sem,
stud_clg_name,(SELECT c_title FROM course_master WHERE id=stud_course) AS stud_course
,stud_fees,stud_paid_amnt,stud_discount,
stud_balance,stud_certificate_no,stud_email
FROM student_master WHERE flag='true'");
// Write data to file
 $i=0;
while ($row = $user_query->fetch(PDO::FETCH_ASSOC)) { $i++;
	?>
			
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['stud_certificate_no']; ?></td>
					<td><?php echo $row['stud_name']; ?></td>
					<td><?php echo $row['stud_email']; ?></td>
					<td><?php echo $row['stud_add']; ?></td>
					<td><?php echo $row['stud_mo']; ?></td>
					<td><?php echo $row['stud_clg_name']; ?></td>
					<td><?php echo $row['stud_branch']; ?></td>
					<td><?php echo $row['stud_sem']; ?></td>
					<td><?php echo $row['stud_course']; ?></td>
					<td><?php echo $row['stud_fees']; ?></td>
					<td><?php echo $row['stud_paid_amnt']; ?></td>
					<td><?php echo $row['stud_discount']; ?></td>
					<td><?php echo $row['stud_balance']; ?></td>
				</tr>			
	<?php  
}
?>
</tbody>
		</table>
		
<?php } else{
	header("location:../index.php");	
}
?>