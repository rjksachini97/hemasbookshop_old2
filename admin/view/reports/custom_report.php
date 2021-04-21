<?php
require_once('tcpdf_include.php');
require_once('../lib/dbconnection.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = "<h1 align='center'><u>All Employee Report </u></h1>";

$dbobj = DB::connect();
$sql = "SELECT * FROM tbl_employee;";
$result = $dbobj->query($sql);
$nor = $result->num_rows;

if($nor==0){
	$html .= "No records found";
}
else{
	$html .="<style type='text/css'>table{border:1px solid #000000}</style>";
	$html .="<table>";
	$html .="<tr>";
	$html .="<th>ID</th>";
	$html .="<th>Name</th>";
	$html .="<th>Address</th>";
	$html .="<th>DoB</th>";
	$html .="<th>Gender</th>";
	$html .="<th>Mobile</th>";
	$html .="<th>Email</th>";
	$html .="</tr>";
	while($rec=$result->fetch_assoc()){
		$html .="<tr>";
		$html .="<td>".$rec["emp_id"]."</td>";
		if($rec["emp_title"]=="1")
			$title = "Mr. ";
		else if($rec["emp_title"]=="2")
			$title = "Ms. ";
		$html .="<td>$title".$rec["emp_name"]."</td>";
		$html .="<td>".$rec["emp_address"]."</td>";
		$html .="<td>".$rec["emp_dob"]."</td>";
		if($rec["emp_gender"]=="1"){
			$html .= "<td>MALE</td>";
		}else{
			$html .= "<td>FeMALE</td>";
		}
		$html .="<td>".$rec["emp_mobile"]."</td>";
		$html .="<td>".$rec["emp_email"]."</td>";
		$html .="</tr>";
	}
	$html .="</table>";
}

// Print text using writeHTML()
$pdf->writeHTML($html, true, 0, true, 0);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('AllEmployees.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


?>