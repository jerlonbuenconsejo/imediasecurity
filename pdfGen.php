<?php
require('./fpdf/pdf.php');
require_once "config/db_config.php";
$db = new Database();
$quoteID = $_GET['quoteID'];
$zipped = "";
$GLOBALS['total'] = 0;
$sql =  $db->getRow("SELECT * FROM `quotation_details`
WHERE quotation_details.id = ".$quoteID."");
	
$vat = $db->getRow("SELECT * FROM vat");

function filter_text($str){	
	$rep = "•";
	$str =  str_replace($rep,"\n".chr(127),$str);
	return ltrim($str, "\n");
}

function setHeader($itemCat){
	global $pdf;
	$pdf->SetFont("Times",'', '12');
	$pdf->SetWidths(array(180));
	$pdf->SetFillColor(19,182,255);
	$pdf->SetDrawColor(19,168,255);
	$pdf->Row(array("{$itemCat}"),false);
	$pdf->SetFont("Arial",'', '8');
	$pdf->SetWidths(array(15,35,60,40,30));
	$pdf->Row(array("QTY","Brand","Equiment Description","Unit Price", "Total Amount"),true);

}

function listItems($cat,$quan, $item){
	global $db, $pdf, $pricing;
	$showed =  [];
	$products = $db->getRow("SELECT * FROM products WHERE id = $item AND itemCat = $cat");
	$price = ($pricing=='D') ? $products->dealer_price : $products->retail_price;
	$total = $quan * $price;
	$pdf->Row(array($quan,$products->itemName,filter_text($products->itemDesc),number_format($price,2), number_format($total,2)),false);
	$GLOBALS['total']+=$total;
}

$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont("Arial",'B', '8');
	$pdf->Cell(40, 6, 'Attention:',0);
	$pdf->SetFont("Arial",'', '8');
	$pdf->Cell(40, 6, "$sql->recipient",0);
	$pdf->Ln(5);
	$pdf->SetFont("Arial",'B', '8');
	$pdf->Cell(40, 6, 'Subject:',0);
	$pdf->SetFont("Arial","", '8');
	$pdf->Cell(40, 6,"$sql->subject" ,0,'C');
	$pdf->Ln(10);
	$pdf->Cell(40,6,"Dear Sir/Ma'am:");
	$pdf->Ln(10);	
	$pdf->MultiCell(0,5,"Thank you for giving us the opportunity to present our CCTV Security Surveillance products. As per your requirements, we are pleased to submit our best offer for the supply of the equipment. The proposal covers the price of equipment.",0);
	$pdf->Ln(5);
	$pdf->MultiCell(0,5,"Rest assured that we will only use quality products that exceeds your highest expectations.",0);
	$pdf->Ln();
	$pdf->SetFont("Arial",'B', '8');
	$pdf->Cell(0,10,"Equipment(s):",0);
	$pdf->Ln(10);
	$itemList	= unserialize($sql->item_list);
	$cat 		= unserialize($sql->category);
	$quantity 	= unserialize($sql->quantity);
	$zipped 	= array_map(null, $itemList, $cat, $quantity);
	$pricing	= $sql->pricing;
	setHeader("Items");
	foreach($zipped as $tuple){
		listItems($tuple[1],$tuple[2],$tuple[0]);
	}
	$pdf->SetFillColor(255,63,77);
	$pdf->SetDrawColor(255,63,77);	
	$pdf->Ln(10);
	$pdf->SetWidths(array(90,90));
	$pdf->SetTextColor(255,255,255);
	$pdf->Row(array("Total Amount","Price"),true);
	$pdf->Ln(0);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetAligns(array("L","R"));
	$vatPer = $vat->vat;
	$vat = $GLOBALS['total']*($vat->vat/100);
	$discount = $sql->discount;
	//print out the total amount of items
	$pdf->Row(array("Total Amount(Without VAT)","Php ".number_format($GLOBALS['total'],2)),false);

	$pdf->Row(array("VAT($vatPer%)","Php ".number_format($vat,2)),false);
	$pdf->Row(array("Discount","Php ".number_format($discount,2)),false);
	$pdf->SetFont("Arial",'B', '8');
	$pdf->Row(array("Overall Total:","Php ".number_format(($total+$vat)-$discount,2)),false);
	$pdf->Ln(5);
	$pdf->SetFont("Arial","B","8");
	$pdf->Cell(0,5,"Warranty",0,0);
	$pdf->SetHR();
	$pdf->SetFont("Arial","B","9");
	$pdf->Ln(10);
	$pdf->SetFont("Arial","",8);
	$pdf->MultiCell(0,5,"iMedia Security Solutions provides a one year warranty on Ubiquiti products.; AVTech DVR, NVR, CCTV Camera, Hard Drive, Monitor and Centralized Power Distribution Unit. Two years warranty on DaHua, HIKVision DVR, NVR, CCTV Camera. iMedia Security Solutions agrees to repair or replace any defective material within the one year warranty period.",0);
	$pdf->Ln(5);
	$pdf->MultiCell(0,5,"iMedia Security Solutions is not liable for any damages due to improper use: rodents, loss, damage or delays occasioned by fire, strikes, lockouts, acts of nature, accidents and boycotts or labor conditions.",0);
	$pdf->Ln(10);
	$pdf->SetFont("Arial","B","8");
	$pdf->Cell(0,5,"Terms and Conditions",0,0);
	$pdf->Ln(5);
	$pdf->SetWidths(array(50,130));
	$pdf->SetAligns("L");
	$pdf->SetFont("Arial","","8");
	$pdf->SetDrawColor(255,255,255);
	$pdf->Row(array("PAYMENT TERMS","50% Down payment upon receipt of the purchase order (For Pickup or Installation clients only).\n50% Balance upon completion of the project (For Pickup or Installation clients only).\n100% Full Payment for provincial clients/orders."),false);
	$pdf->Ln(5);
	$pdf->Row(array("PRICE VALIDITY","Total prices quoted herein are in Philippine Pesos, valid for five days from date of proposal."),false);
	$pdf->Ln(5);
	$pdf->Row(array("WARRANTY","Hardware - one year on parts and in-house service from the date of delivery, covering factory defects.\nSoftware - Operating system and other software installed are not covered by warranty.\n\nWarranty on equipment is 12 months upon delivery or turnover of project.\nDefects arising from improper handling, misuse, abuse, neglect, prolonged operation, excessive wear, improper electrical connection, poor operating environment, fire and other natural calamities.  "),false);
	$pdf->Ln(5);
	$pdf->Row(array("LEAD TIME","Products ordered will be available within 5 - 10 working days upon signing the purchase order.\n\nAll freight and transport expenses incurred in the delivery of the products inside/outside Metro Manila and in case of rush order shall be for the account of the client."),false);
	$pdf->Ln(5);
	$pdf->Row(array("CANCELLATION","Please note all cancelled orders are subject to a cancellation charge of: \n40% for orders of P 10,000 and above\n25% for orders of P 10,000 and below"),false);
	$pdf->Ln(5);
	$pdf->Row(array("OVERDUE","Overdue payments are subject to 3% per monthly interest charge."),false);
	$pdf->Ln(5);
	$pdf->Row(array("SCHEDULING ","Scheduling of job and mobilization will proceed after down payment has been received."),false);
	$pdf->Ln(10);

	$pdf->SetWidths(1);
	$pdf->SetFont("Arial","B","8");
	$pdf->Row(array("Purchase Order Agreement"),false);
	$pdf->SetFont("Arial","","8");
	$pdf->Ln(5);
	$pdf->Row(array("This purchase order in the amount of Php _____________________ plus VAT is in accordance with the prices, terms and specifications listed above. Any work not within the scope of this proposal may incur additional cost. "),false);
	$pdf->Ln(5);	
	$pdf->Row(array("Please sign below. "),false);
	$pdf->Ln(5);
	$pdf->Row(array("Customer Acceptance  "),false);
	$pdf->Ln(5);
	$pdf->Row(array("Signature: ___________________________ Date: ________________________________ "),false);
	$pdf->Ln(5);
	$pdf->Row(array("Print: _______________________________ Company: ____________________________ "),false);
	$pdf->Ln(5);
	$pdf->Row(array("Acknowledgement "),false);
	$pdf->Ln(5);
	$pdf->SetFont("Arial","B","8");
	$pdf->Row(array("iMedia Security Solutions  "),false);

	$pdf->Output();
?>