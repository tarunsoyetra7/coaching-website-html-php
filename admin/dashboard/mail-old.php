<?php
$txt_certificate="100001";
$txt_name="Prateek Chandrakar";
$txt_mobile="0009998887";
$c_title="Web Designing";
$txt_paid="5000";
$txt_balance="5000";
$txt_email="prateekchandrakar485@gmail.com";
$mess1 = "<html><head><title>Mail Option</title></head><body>";	
	$mess2 = "";	
	$mess3 = 	"
	Certificate No : ".$txt_certificate."<br><br>
Name of Candidate :".$txt_name." <br><br>
Mobile No: ".$txt_mobile."<br><br>
Registered Course: ".$c_title." <br><br>
We have received your registration to participate in the <b>Vocational Training Program</b> at the Sensible Computers. Welcome! We are excited to have you in our class and commend you for furthering your education and career with a professional designation. <br><br>

This designation is a symbol of your commitment to not only the IT (Software) industry but also to your own professional development.<br><br>

You have already paid <b>".$txt_paid." Rs.</b> amount and your balance amount is :<b> ".$txt_balance." Rs.</b><br><br> You have to clear your balance amount before commencing your first class of training.<br><br>

We will confirm your complete registration prior to our first class.<br><br>

Please let me know if I may assist you in any way prior to the start of class.<br><br>

Regards,<br><br>

Piyush Jain,<br><br>

Director<br><br>

7722899444,9301351989
";
	
	$to1 =$txt_email; 	
	$subject1 = "Enquiry check in www.sensible-computers.com";	
	$message1 = $mess1.$mess2.$mess3;	
	$from1= "hr@sensible-computers.com";		
	$headers  = "From: $from1\r\n"; 	
	$headers .= "Content-type: text/html\r\n"; 		
	mail($to1,$subject1,$message1,$headers);
	
	