<?php 
	require_once "../config/db_config.php";
	$db = new Database();
	$cid = $_POST['cat'];
	$item = $db->getRows("SELECT * FROM products WHERE itemCat = $cid AND flag = 1");
	foreach($item as $res){
		echo"<option value='".$res->id."'>".$res->itemName." ()</option>";
	}

?>