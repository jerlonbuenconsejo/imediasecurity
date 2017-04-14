<?php 
require_once 'config/db_config.php';
$db = new Database();
if($db->logout()){
	$db->redirect("login.php");
}
?>