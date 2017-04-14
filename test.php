<?php 
require('./fpdf/pdf.php');
require_once "config/db_config.php";
$db = new Database();
$zipped = "";
$GLOBALS['total'] = 0;
$sql =  $db->getRow("SELECT * FROM `quotation_details`
WHERE quotation_details.id = 2");

$itemList	= unserialize($sql->item_list);
	$cat 		= unserialize($sql->category);
	$quantity 	= unserialize($sql->quantity);
	$zipped 	= array_map(null, $itemList, $cat, $quantity);
	$pricing	= $sql->pricing;
	print_r($cat);
	echo "<br>"; 
	print_r(array_unique($cat));
?>

