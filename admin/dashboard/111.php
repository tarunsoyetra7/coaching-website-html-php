<?php
$message = '<html><body> <table rules="all" style="border-color: #333; width:60%;" border="1" cellpadding="10"> <tr style="padding:0px;"> <td colspan="2" align="center"><img src="http://www.sensible-computers.com/image/sens_logo.jpg" alt="" style="width:100%;"/></td> </tr> <tr style="background: #eee;"> <td>Head Office </td> <td>106, D-Block, Om-Parisar, Near Railway Station, Durg (C.G.)</td> </tr> <tr> <td>Branch Office </td> <td>Near Gupta Phataka, Junwani Road, Smriti Nagar, Bhilai (C.G.)</td> </tr> <tr style="background: #eee;"> <td>Contacts</td> <td>77228-99444, 0788-4011037</td> </tr> <tr> <td>Website </td> <td>www.sensible-computers.com</td> </tr> <tr style="background: #eee;"> <td>Recipt No</td> <td>101</td> </tr> <tr> <td>Recipt Date</td> <td>10 Dec 2019</td> </tr> <tr style="background: #eee;"> <td>Student Id</td> <td>10001</td> </tr> <tr> <td>Student Name</td> <td>Prateek Chandrakar</td> </tr> <tr style="background: #eee;"> <td>Course Name</td> <td>Web Designing</td> </tr> <tr> <td>Course Fees</td> <td>10,000 rs</td> </tr> <tr style="background: #eee;"> <td>Prev. Paid Amount</td> <td>5000 rs</td> </tr> <tr> <td>Recive Amount</td> <td>5000 rs</td> </tr> <tr style="background: #eee;"> <td>Balance Fees</td> <td>0 rs</td> </tr> </table> </body></html>';

$to1 ="prateekchandrakar485@gmail.com"; 	
	$subject1 = "Enquiry check in www.sensible-computers.com";	
	$message1 = $message;	
	$from1= "hr@sensible-computers.com";		
	$headers  = "From: $from1\r\n"; 	
	$headers .= "Content-type: text/html\r\n"; 		
	mail($to1,$subject1,$message1,$headers);	
	
?>