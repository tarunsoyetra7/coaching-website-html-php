<?php
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
$pdf->AddPage();

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------


$tbl = <<<EOD


<table width="100%" border="1" cellpadding="8">

    <tr>
        <th  colspan="7" align="center">SET PROGRAME FINAL ASSESSMENT STUDENT DOCUMENT VERIFICATION ATTENDANCE SHEET</th>
    </tr>

    <tr>
        <th colspan="2" >SET PROGRAMME
            <br><strong>TRADE</strong>: DRESS MAKING & TAILORING
        </th>

        <th colspan="2" >CENTER: SAHITYA EDUCATION CENTER
        </th>

        <th colspan="2" >ADDRESS: VILL- KANNEWADA, BALOD(CG)</th>

        <th colspan="1" >DATE:</th>

    </tr>

    <tr>
        <th align="center">S No.</th>
        <th align="center">Enrollment No.</th>

        <th align="center">Name of the Student</th>
        <th align="center" >Fathers Name</th>

        <th align="center" >Signature of the Student</th>
        <th align="center">Date of Birth</th>

        <th align="center">Student Mobile Number (In Writing)</th>
    </tr>

    <tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/test.jpg" alt="test alt attribute" width="60" height="60" border="0" />
		<div style="clear:both;"></div>
			<div style="padding:20px; border-radius:5px; border-color:1px solid #ccc;"></div>
		</th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>


<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>



<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>



<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>



<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>


<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>


<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>



<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>



<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>



<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>


<tr>
        <td align="center">1</td>
        <td align="center">ITSPL03/SETPST01</td>
        <td align="center">HULSI PATEL</td>
        <td align="center">HARAKH RAM</td>
        <th align="center"><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /></th>
        <td align="center"></td>
        <td align="center"></td>
    </tr>

   
    

</table>


EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
