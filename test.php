<?php 
require_once "includes/function.php";
$s = 'stri"';

$itemName1 = e($s);
$itemName = str_replace('&quot;', "&quo", e($s));

echo "<script>alert('$itemName name')</script>";


?>

