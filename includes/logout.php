<?php 
$check = $db->logout();
if($check){
	$db->redirect("login.php");
}
?>