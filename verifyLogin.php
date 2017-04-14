<?php 
if($db->is_loggedin()!=true)
	{
	 $db->redirect('login.php');
	}
?>