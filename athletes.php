<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>Athletes Task</title>
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
	text-align:left;
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
//get info from form
$countryID = $_GET['country_id'];
$partName = $_GET['part_name'];


//authentication from file
include 'auth.php';

//create connection
$host='localhost'; 
$dbName='coa123cdb';
$dsn = "mysql://$username:$password@$host/$dbName";
require_once('MDB2.php');
$db = & MDB2::connect($dsn);
if (PEAR::isError($db)) {
	die($db->getMessage()); 
}

//the query
$sql = "SELECT name, gender, weight, height FROM Cyclist WHERE name LIKE '%$partName%' AND ISO_id LIKE '%$countryID%'";
$result = &$db->query($sql);
if(PEAR::isError($result)){
	die($result->getMessage());
}

//gets number of results
$resNum = $result->numRows();

//echo's required html for the table with the results from the query
echo "<table border=1>";
echo "<tr><th>Name</th><th>Gender</th><th>BMI</th></tr>";

for($i = 0; $i < $resNum; $i++){
	$row = $result->fetchRow();
	$name = $row[0];
	$gender = $row[1];
	if(intval($row[2]) == 0 || intval($row[3]) == 0){
		$bmi = "N/A"; //some people don't have weight or height, this shows "N/A" is this is the case.
	}else{
		$bmi = BMI_calc(intval($row[2]),intval($row[3]));
	}
	echo "<tr><td>$name</td><td>$gender</td><td>$bmi</td></tr>";
}
echo "</table>";

//function from BMI.php to get the bmi form weight and height.
function BMI_calc($weight, $height){
	$BMI = number_format(($weight / (($height/100) * ($height/100))), 3,'.','');
	return ($BMI);
}
?>
</html>
