<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>BMI Task</title>
<style type="text/css">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: bisque;
}
.center {
	text-align:center;
}
body,td,th {
	color: brown; 
}
.larger {
	font-size:larger;
	text-align:right;
}
table {
	margin-left:auto;
	margin-right:auto;
}
.fixed {
	font-family: Courier, monospace;
	white-space: pre;
	background-color:cornsilk;
}
</style>
</head>
<?php
$min_weight = $_GET["min_weight"];
$max_weight = $_GET["max_weight"];
$min_height = $_GET["min_height"];
$max_height = $_GET["max_height"];
$col = ($max_weight - $min_weight) / 5;
$row = ($max_height - $min_height) / 5;
echo "<table border=1>";
for($i = 0; $i <= $col+1; $i++){
	echo "<tr>";
	for ($n=0; $n <= $row+1; $n++){
		if($n==0 && $i==0){
			echo "<td></td>";
		}
		if($n==0 && $i > 0){
			$input = ($min_weight + 5*($i-1));
			echo "<td>$input</td>";
		}
		else if($i==0 && $n > 0){
			$input = ($min_height + 5*($n-1));
			echo "<td>$input</td>";
		}else if($n > 0 && $i > 0){
			$input = BMI_calc($min_weight + 5*($i-1), $min_height + 5*($n-1));
			echo "<td>$input</td>";
		}
	}
	echo "</tr>";
}
echo "</table>";

function BMI_calc($weight, $height){
	$BMI = number_format(($weight / (($height/100) * ($height/100))), 3,'.','');
	return ($BMI);
}
?>
</body>
</html>