<?php 

$arr = [7,8,1,2,5,3,6,4,6,43,22,11,43,6,23,8];//

for($i = 0;$i<=count($arr)-1; $i++){
	for($j = 0; $j<=$i; $j++){
		if($arr[$j]>
			$arr[$i]){
			$temp = $arr[$i];
			$arr[$i] = $arr[$j];
			$arr[$j] = $temp;
		}

	}
}
foreach($arr as $res){
	echo $res."<BR>";
}
?>