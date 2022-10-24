<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>Details Task</title>
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

.result td {
	width:250px;
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
//get dates and format them to work with the sql statment.
$dateOneList = explode('/',$_GET['date_1']);
$date1 = $dateOneList[2]."-".$dateOneList[1]."-".$dateOneList[0];
$dateTwoList = explode('/',$_GET['date_2']);
$date2 = $dateTwoList[2]."-".$dateTwoList[1]."-".$dateTwoList[0];

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

//FIND OUT WHAT INCLUSIVE MEANS I THINK <= BUT IDk

$sql = "SELECT t1.name, t2.country_name, t2.gdp, t2.population FROM Cyclist as t1 JOIN Country as t2";
$sql .= " ON t1.ISO_id = t2.ISO_id WHERE t1.dob >= '$date1' AND t1.dob <= '$date2'";
$result = &$db->query($sql);
if(PEAR::isError($result)){
	die($result->getMessage());
}

echo json_encode($result->fetchAll());


?>
</html>
