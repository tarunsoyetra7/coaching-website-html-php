<?php if(isset($_COOKIE['login']))
{	
	require("../../root/db_connection.php");
	
?>
<?php
$filename = "all_transcation_history.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table >
                        	<thead >
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
	
                            </tbody>
                              
                        </table>
		
<?php } else{
	header("location:../index.php");	
}
?>