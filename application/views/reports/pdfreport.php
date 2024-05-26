<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
//$title = "PDF Report";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
    //$content = ob_get_contents();
    
	$personalInfo = '<table >
						<tr>
							<td>Name:</td> 
							<td>Khan</td> 
						</tr>
						<tr>
							<td>Father Name:</td> 
							<td>Father name</td> 
						</tr>
						<tr>
							<td>Date of birth:</td> 
							<td>2010-01-31</td> 
						</tr>
					</table>'; 
	$academicInfo ='<table>
						<tr>
							<td>Roll No.:</td> 
							<td>23</td> 
						</tr>
						<tr>
							<td>Class :</td> 
							<td>Class-6</td> 
						</tr>
						<tr>
							<td>Admission Date:</td> 
							<td>2013-01-01</td> 
						</tr>
					</table>';

	
	$feeSummary ='<br/><br/><br/><table><tr><td align="center"><h3>Fee Summary</h3></td></tr></table><hr/>
	
				<table cellpadding="2">
					<tr>
						<th width="10%">#</th>
						<th width="35%">Type</th>
						<th width="20%">Date/Month</th>
						<th width="15%">Status</th>
						<th width="20%">Amount(PKR)</th>
					</tr>
					<tr>
						<td colspan="5"><hr/></td>
					</tr>
					<tr>
						<td>1 </td>
						<td>Montdly Tuition Fee</td>
						<td>2014 - 12</td>
						<td>Paid</td>
						<td>2800</td>
					</tr>
					<tr>
						<td>2 </td>
						<td>Monthly Tuition Fee</td>
						<td>2014 - 12</td>
						<td>Paid</td>
						<td>2800</td>
					</tr>
					<tr>
						<td>3 </td>
						<td>Monthly Tuition Fee</td>
						<td>2014 - 12</td>
						<td>Paid</td>
						<td>2800</td>
					</tr>
					
				</table>
			
				<hr/>
				
				<table>
					<tr>
						<td width="60%"></td>
						<td width="25%"><b>Total Fee Paid</b></td>
						<td width="15%" ><b>5000/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td  ><b>Remaining Fee Dues</b></td>
						<td  ><b>0/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
				</table>
				
				
				
				' ;
	$inventorySummary ='<br/><br/><br/><table><tr><td align="center"><h3>Inventory Summary</h3></td></tr></table><hr/>
	
				<table cellpadding="2">
					<tr>
						<th width="10%">#</th>
						<th width="35%">Name</th>
						<th width="20%">Quantity</th>
						<th width="15%">Issued Date</th>
						<th width="20%">Unit Price (PKR)</th>
						
						
					</tr>
					<tr>
						<td colspan="5"><hr/></td>
					</tr>
					<tr>
						<td>1 </td>
						<td>Note Book</td>
						<td>2</td>
						<td>2014-12-24</td>
						<td>80</td>
					</tr>
					<tr>
						<td>2 </td>
						<td>English Book - 1</td>
						<td>2</td>
						<td>2014-12-24</td>
						<td>2800</td>
					</tr>
					
					
				</table>
			
				<hr/>
				<table>
					<tr>
						<td width="60%"></td>
						<td width="25%"><b>Total Inventory Paid</b></td>
						<td width="15%" ><b>5000/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td  ><b>Remaining Inventory Dues</b></td>
						<td  ><b>0/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
				</table> ' ;
	
	$total = '<br/><br/><br/><table><tr><td align="center"><h3>Total</h3></td></tr></table><hr/>
				<table>
					<tr>
						<td width="60%"></td>
						<td width="25%"><b>Total Payable</b></td>
						<td width="15%" ><b>5000/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td  ><b>Total Paid</b></td>
						<td  ><b>5000/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
					<tr>
						<td ></td>
						<td  ><b>Remaining Dues</b></td>
						<td  ><b>0/-</b></td>
					</tr>
					<tr>
						<td ></td>
						<td colspan="2" ><hr/></td>
					</tr>
				</table>';
	
	
    $content = '<table>
					<tr>
						<td colspan="3" align="center"><h2><u>Fee Receipt</u></h2></td> 
					</tr>
					
					<tr>
						<td><h3>Personal Information</h3></td> 
						<td></td> 
						<td><h3>Academic Information</h3></td> 
					</tr>
					<tr>
						<td colspan="3" ><div style="margin: 5px;"></div></td> 
					</tr>
					
					<tr>
						<td>'.$personalInfo.'</td>
						<td></td> 
						<td>'.$academicInfo.'</td> 
					</tr>
					<tr>
						<td colspan="3" >
							<div style="margin: 5px;"></div>
							
						</td> 
					</tr>
					<tr>
						<td colspan="3" >'.$feeSummary.'</td> 
					</tr>
					<tr>
						<td colspan="3" >
							<div style="margin: 5px;"></div>
							
						</td> 
					</tr>
					<tr>
						<td colspan="3" >'.$inventorySummary.'</td> 
					</tr>
					<tr>
						<td colspan="3" >
							<div style="margin: 5px;"></div>
							
						</td> 
					</tr>
					<tr>
						<td colspan="3" >'.$total.'</td> 
					</tr>
				</table>';
ob_end_clean();
//echo $content; exit;

$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');