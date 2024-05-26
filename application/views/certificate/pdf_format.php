<?php //pre_d($certificate['name']);
tcpdf();
$obj_pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle($certificate['name']);
//$obj_pdf->SetHeaderData('', 100, $certificate["name"], $certificate["name"]);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(0);
$obj_pdf->SetMargins(0, 0, 0);
$obj_pdf->SetAutoPageBreak(false, 0);
$obj_pdf->SetFont('comic', '', 10);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();

//$pdf->SetAutoPageBreak(false, 0);
$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$img_file = $certificate['background_image'];

$pageSize = explode(",",$certificate['page_size']);

$obj_pdf->Image($img_file, 0,0, 650,900, '', '', '', true, 72, 'C', false, false, 0, false, false,true);
//Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

$reporFileName =  $certificate['name'];
//$reporFileName =  $certificate['name'].'.pdf';
ob_end_clean();
$html = getCertificateContents($certificate);
//pre_d($html);
$obj_pdf->writeHTML($html, true, false, true, false, '');

$obj_pdf->Output($reporFileName, 'I');


