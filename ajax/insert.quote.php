<?php 
require_once "../config/db_config.php";
$db = new Database();
$cat 		= serialize(json_decode($_POST['category']));
$itemlist 	= serialize(json_decode($_POST['itemlist']));
$quantity   = serialize(json_decode($_POST['quantity']));
$category 	= $_POST['category'];
$email 		= $_POST['email'];
$recipient 	= $_POST['recipient'];
$subject 	= $_POST['subject'];
$company 	= $_POST['company'];
$pricing 	= $_POST['pricing'];
$discount	= $_POST['discount'];
$dateCreated= date('F j, Y');
$db->insertRow("INSERT into quotation_details(subject,recipient,company,email,item_list,category,quantity,pricing,discount,dateCreated) 
	VALUES(?,?,?,?,?,?,?,?,?,?)",[$subject,$recipient,$company,$email,$itemlist,$cat,$quantity,$pricing,$discount,$dateCreated]);

?>