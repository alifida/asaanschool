<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle($header["logo"]);
 
$obj_pdf->SetHeaderData($header["logo"], $header["logo_width"], $header["title"], $header["header_string"]);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$top_margin = PDF_MARGIN_TOP;
if(!empty($header["logo_width"]) && is_numeric($header["logo_width"])){
	$top_margin = $header["logo_width"]+7;
}
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, $top_margin, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 10);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
// we can have any view part here like HTML, PHP etc
//$content = ob_get_contents();

$personalInfo = '<table >
						<tr>
							<td colspan="2"><h4>Personal Information</h4></td>
						</tr>
						<tr>
							<td width="35%">Name:</td>
							<td width="65%">'.$studentDetails["first_name"].' '.$studentDetails["last_name"].'</td>
						</tr>
						<tr>
							<td >Father Name:</td>
							<td>'.$studentDetails["father_name"].'</td>
						</tr>
						<tr>
							<td>Date of birth:</td>
							<td>'.$studentDetails["date_of_birth"].'</td>
						</tr>
						<tr>
							<td>Email:</td>
							<td style="font-size:8px">'.$studentDetails["email"].'asdfsdfas@asdfsdfsdfsdl.com</td>
						</tr>
						 
					</table>';


$academicInfo ='<table>
						<tr>
							<td colspan="2"><h4>Academic Information</h4></td>
						</tr>';
 
$academicInfo = $academicInfo.'	<tr>
							<td>Reg No.:</td>
							<td>'.$studentDetails["reg_no"].'</td>
						</tr>';
 
$academicInfo = $academicInfo.' <tr>
							<td>Roll No.:</td>
							<td>'.$studentDetails["roll_no"].'</td>
						</tr>
						<tr>
							<td>Class :</td>
							<td>'.$studentDetails["class"]["name"].'</td>
						</tr>
						<tr>
							<td>Admission Date:</td>
							<td>'.$studentDetails["admission_date"].'</td>
						</tr>
						 
					</table>';
$feeExist = false;
$inventoryExist = false;
$feeSummary = "";
$totalFeePaid = 0;
if(isset($transaction["studentFee"]) && !empty($transaction["studentFee"])){
	$feeExist = true;
	$feeSummary ='<table><tr><td align="center"><h4>Fee Summary</h4></td></tr></table>
			
				<table cellpadding="2" style="border: 1px solid #F0F0F0;">
					<tr style="background-color: #F0F0F0; ">
						<th width="10%" >#</th>
						<th width="35%">Type</th>
						<th align="center" width="20%">Date/Month</th>
						<th align="center" width="15%">Status</th>
						<th align="center" width="20%">Amount(PKR)</th>
					</tr>
					';
	foreach($transaction["studentFee"] as $key => $studentFee){
		$sno = $key+1;
		$feeSummary = $feeSummary. '<tr>
						<td>'.$sno .'</td>
						<td>'.$studentFee["fee_type"]["type"].'</td>
						<td align="center">'.$studentFee["fee_date"].'</td>
						<td align="center">'.$studentFee["payment_status"].'</td>
						<td align="center">'.$studentFee["amount"].'</td>
					</tr>';
		$totalFeePaid = $totalFeePaid + $studentFee["amount"];
	}
	
	
	$feeSummary = $feeSummary. '</table>
			
			
				<table>
					<tr>
						<td width="60%"></td>
						<td align="left" width="25%"><b>Total Fee</b></td>
						<td align="center" width="15%" ><b>'.$totalFeePaid.'/-</b></td>
					</tr>
								
					<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
				</table>
				' ;
}

$inventorySummary = "";
$totalInventoryPaid = 0;
if(isset($transaction["studentItems"]) && !empty($transaction["studentItems"])){
	$inventoryExist = true;
	$inventorySummary ='<table><tr><td align="center"><h4>Inventory Summary</h4></td></tr></table>
				<table cellpadding="2" style="border: 1px solid #F0F0F0;">
					<tr style="background-color: #F0F0F0; ">
						<th width="10%">#</th>
						<th width="35%">Name</th>
						<th align="center" width="20%">Quantity</th>
						<th align="center" width="15%">Issued Date</th>
						<th align="center" width="20%">Amount(PKR)</th>
					</tr>';
	foreach($transaction["studentItems"] as $key => $studentItem){
		$sno = $key+1;
		$inventorySummary = $inventorySummary .
		'<tr>
						<td>'.$sno.'</td>
						<td>'.$studentItem["item"]["description"].'</td>
						<td align="center">'.$studentItem["issued_amount"].'</td>
						<td align="center">'.$studentItem["issue_date"].'</td>
						<td align="center">'.$studentItem["due_money"].'</td>
					</tr>';
		$totalInventoryPaid = $totalInventoryPaid  + $studentItem["due_money"];
	}
	
	
	$inventorySummary = $inventorySummary.
	'</table>
			
				<table>
					<tr>
						<td width="60%"></td>
						<td width="25%"><b>Total Inventory </b></td>
						<td width="15%" align="center" ><b>'.$totalInventoryPaid.'/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
				</table> ' ;
}

$totalSummary = "";

$discountAmount = 0;

if(isset($transaction["studentDiscounts"]) && !empty($transaction["studentDiscounts"])){
	foreach($transaction["studentDiscounts"] as $key=> $discount){
		$discountAmount = $discountAmount + $discount["discount_amount"];
	}
}



if(($feeExist && $inventoryExist)|| ($discountAmount > 0) ){
	$totalSummary = '<table><tr><td align="center"><h4>Total</h4></td></tr></table><hr/>';
	
	
	
	$totalPaid = $totalFeePaid + $totalInventoryPaid;
	
	$totalPaid = $totalPaid - $discountAmount;
	
	$totalSummary = $totalSummary .'<table>';
	
	if($feeExist && $inventoryExist){
		$totalSummary = $totalSummary .'<tr>
							<td width="60%"></td>
							<td width="25%"><b>Total Fee </b></td>
							<td width="15%" align="center"  ><b>'.$totalFeePaid.'/-</b></td>
						</tr>
						<tr>
							<td ></td>
							<td  ><b>Total Inventory </b></td>
							<td align="center"  ><b>'.$totalInventoryPaid.'/-</b></td>
						</tr>';
	}
	
	if($discountAmount > 0){
		$totalSummary = $totalSummary .'<tr>
							<td width="60%"></td>
							<td width="25%"><b>Discount </b></td>
							<td width="15%" align="center"  ><b>'.$discountAmount.'/-</b></td>
						</tr>';
	}
	$remainingDues = 0;
	if(!empty($transaction["remaining_amount"])){
		$remainingDues = $transaction["remaining_amount"];
	}
	
	$totalPaid = $totalPaid - $remainingDues;
	$totalSummary = $totalSummary .'<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
					<tr>
						<td ></td>
						<td ><b>Total Paid </b></td>
						<td align="center" ><b>'.$totalPaid.'/-</b></td>
					</tr> ';
	if($remainingDues > 0){
		$totalSummary = $totalSummary .'<tr>
							<td width="60%"></td>
							<td width="25%"><b>Remaining Dues </b></td>
							<td width="15%" align="center"  ><b>'.$remainingDues.'/-</b></td>
						</tr>';
	}
	$totalSummary = $totalSummary .'  </table>';
}

$studentInfo ='	<table border="0">
					<tr>
						<td align="center" colspan="3" ><h4>Student Details</h4></td>
					</tr>
					<tr>
						<td align="center" colspan="3" ><hr/></td>
					</tr>
					<tr>
		
						<td width="40%"   style="border: 1px solid #B0B0B0">
							<table style="background-color: #F2F2F2" >
								<tr>
									<td width="2%"></td>
									<td width="98%"> '.$personalInfo.' </td>
								</tr>
							</table>
						</td>
						<td width="20%" ></td>
						<td width="40%" style="border: 1px solid #B0B0B0" >
							<table style="background-color: #F2F2F2">
								<tr>
									<td width="2%"></td>
									<td width="98%"> '.$academicInfo.' </td>
								</tr>
							</table>
						</td>
											
											
					</tr>
					<tr>
						<td  colspan="3" ><br/><hr/></td>
					</tr>
				</table>';

$invoiceDate = (isset($transaction["updated_at"]))?   $transaction["updated_at"]:"____-__-__ __:__";
if(strlen($invoiceDate) >= 19){
	$invoiceDate = substr($invoiceDate,0,16);
}
$paymentDetails = '<table >
						 
						<tr>
							<td>Paid By:</td>
							<td>'.$paymentMadeBy.'</td>
						</tr>
						<tr>
							<td>Payment Date:</td>
							<td>'.$invoiceDate.'</td>
						</tr>
						<tr>
							<td>Print Date:</td>
							<td>'.substr(getCurrentDateTime(),0,16).'</td>
						</tr>
						 
					</table>';

$stamp =$header["stamp"];
if(isset($header["stamp"]) && !empty($header["stamp"])){
	$stamp = '<img src="'.$header["stamp"].'" width="60"  >';
}
$metaInfo ='	<table border="0">
					<tr>
						<td align="center" colspan="3" ><h4></h4></td>
					</tr>
					<tr>
						<td align="center" colspan="3" ><hr/></td>
					</tr>
					<tr>
		
						<td width="40%"  style="border: 1px solid #D0D0D0;" >
							<table>
		
								<tr>
									<td width="5%"></td>
									<td width="95%"> <br/><br/>'.$paymentDetails.' </td>
								</tr>
							</table>
						</td>
						<td width="20%" ></td>
						<td width="40%"  style="border: 1px solid #D0D0D0;" >
							<table style="font-size:3px;">
								<tr>
									<td width="5%"></td>
									<td width="95%"></td>
								</tr>
								<tr>
									<td width="5%"></td>
									<td width="95%" style="text-align: center">'.$stamp.' </td>
								</tr>
								<tr>
									<td width="5%"></td>
									<td width="95%"></td>
								</tr>
							</table>
						</td>
											
											
					</tr>
					<tr>
						<td  colspan="3" ><br/><hr/></td>
					</tr>
				</table>';



$content = '<table style="font-size: 9px;">
					<tr>
						<td colspan="3" align="right"><u>Invoice Date</u>: '.$invoiceDate.'</td>
					</tr>
					<tr>
						<td colspan="3" align="center"><h3><u>Receipt</u></h3></td>
					</tr>
								
					<tr>
						<td colspan="3" ><div style="margin: 5px;"></div></td>
					</tr>
								
					<tr>
								
						<td colspan="3">'.$studentInfo.'</td>
								
					</tr>
					 
					<tr>
						<td colspan="3" >'.$feeSummary.'</td>
					</tr>
					 
					<tr>
						<td colspan="3" >'.$inventorySummary.'</td>
					</tr>
								
					 
					<tr>
						<td colspan="3" >'.$totalSummary.'</td>
					</tr>
					 
					 
					<tr>
						<td colspan="3" >'.$metaInfo.'</td>
					</tr>
				</table>';
//pre_d($header);
$reporFileName = $studentDetails["first_name"].'_'.$studentDetails["first_name"] .'_'.$studentDetails["class"]["name"].'_'.$studentDetails["roll_no"].'.pdf';
ob_end_clean();

$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output($reporFileName, 'I');


