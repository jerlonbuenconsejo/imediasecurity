<?php 
include "../config/db_config.php";
$db = new Database();
$id = $_POST['uid'];
$table = $_POST['tablename'];
$db->updateRow("UPDATE $table SET flag = 0 WHERE id  = ?", [$id]);    
 ?>