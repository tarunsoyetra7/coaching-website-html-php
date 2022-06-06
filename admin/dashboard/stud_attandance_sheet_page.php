<?php

if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");
	
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');



//$id=str_replace("'","",$_REQUEST['id']);

$ins_id=str_replace("'","",$_REQUEST['ins_id']);
$c_id=str_replace("'","",$_REQUEST['c_id']);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
//$pdf->AddPage();

$pdf->AddPage('L', 'A4');


//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

$fetchCenterDetail=$db->query("SELECT t_c_name,t_cmp_add,o_c_n_name FROM center_info_master WHERE id=$ins_id AND flag='true'") or die("");

$fetchCenterDetail_res=$fetchCenterDetail->fetch(PDO::FETCH_ASSOC);



$fetchCourseName=$db->query("select c_name from course_master where id=$c_id") or die("");
$fetchCourseName_q=$fetchCourseName->fetch(PDO::FETCH_ASSOC);


$c_name=str_replace("&amp;","&",$fetchCourseName_q['c_name']);
$center_name=$fetchCenterDetail_res['t_c_name'];

$c_address=$fetchCenterDetail_res['t_cmp_add'];



$fechStudQ=$db->query("SELECT id,(SELECT c_name FROM course_master WHERE id=course_id) AS course_name,stud_enroll_no,stud_image,stud_name,stud_mo,stud_m_name,stud_f_name FROM student_master  WHERE flag='true' AND institut_id=$ins_id and course_id=$c_id ORDER BY id desc") or die("");

$i1=0;

$empty_abc="";

while($fechStudQ_res=$fechStudQ->fetch(PDO::FETCH_ASSOC)){ $i1++;

	if($fechStudQ_res['stud_image']=="" || $fechStudQ_res['stud_image']==NULL){
		$studProfile="../../stud_documents/default_image.jpg";
	}
	else{
		$studProfile="../../stud_documents/".$fechStudQ_res['stud_image'];
	}

	$abc='
<tr>
        <td align="center">'.$i1.'</td>
        <td align="center">'.$fechStudQ_res['stud_enroll_no'].'</td>
        <td align="center">'.$fechStudQ_res['stud_name'].'</td>
        <td align="center">'.$fechStudQ_res['stud_f_name'].'</td>
         <td align="center"></td>
        <td align="center"></td>
</tr>';


	$empty_abc=$empty_abc.$abc;
    
}

$tbl = <<<EOD


<table width="100%" border="1" cellpadding="12">

    <tr>
        <th align="center" colspan="6">  DAILY TRAINING ATTENDANCE SHEET, SET PROGRAMME,     OM SAI NATH, $center_name                                      (CG)<br>
		DATE……………………………………..,     TRADE- $c_name</th>
    </tr>

  

    <tr>
        <th align="center" colspan="1">S No.</th>
        <th align="center" colspan="1">Enrollment No.</th>

        <th align="center" colspan="1">Name of the Student</th>
        <th align="center" colspan="1">Fathers Name</th>

        <th align="center" colspan="1">Signature of the Student</th>
        <th align="center" colspan="1">Training Remarks</th>
    </tr>


	$empty_abc
	
	
    
   
    

</table>


EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output($center_name.".pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+
}
else
{
	header("location:../index.php");	
}