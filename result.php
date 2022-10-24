<?php
$ammount = $_REQUEST['values'];
$ISO_id1 = $_REQUEST['ISO_id1'];
$ISO_id2 = $_REQUEST['ISO_id2'];
$ISO_id3 = $_REQUEST['ISO_id3'];
$ISO_id4 = $_REQUEST['ISO_id4'];
$sorting = $_REQUEST['sorting'];

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

$sqlCountries = "SELECT country_name, ISO_id, total, gdp, population FROM Country WHERE ISO_id LIKE '$ISO_id1' OR ISO_id LIKE '$ISO_id2' OR ISO_id LIKE '$ISO_id3' OR ISO_id LIKE '$ISO_id4'";
$sqlCountries .= " ORDER BY total DESC";

$sqlCyclist = "SELECT ISO_id, name FROM Cyclist WHERE ISO_id LIKE '$ISO_id1' OR ISO_id LIKE '$ISO_id2' OR ISO_id LIKE '$ISO_id3' OR ISO_id LIKE '$ISO_id4'";

$countryResult = &$db->query($sqlCountries);
if(PEAR::isError($countryResult)){
	die($countryResult->getMessage());
}
$numRows = $countryResult->numRows();
$countryArray = $countryResult->fetchAll();
switch($sorting){
	case "gpdPop":
		usort($countryArray, 'sortArrayGdpPop');
		break;
	case "medals":
		usort($countryArray, 'sortArrayMedals');
		break;
}

$cyclistResult = &$db->query($sqlCyclist);
if(PEAR::isError($cyclistResult)){
	die($result->getMessage());
}
$cyclistArray = $cyclistResult->fetchAll();

echo "<table border=1>";
for($i=0; $i < 5;$i++){
	switch($i){
		case 1:
			echo "<tr><td style='vertical-align:top'><b>Country Name</b></td>";
			foreach($countryArray as $country){
				$cn = $country[0];
				echo "<td class='result'>$cn</td>";
			}
			break;
		case 2:
			echo "<tr><td style='vertical-align:top'><b>ISO_id</b></td>";
			foreach($countryArray as $country){
				$cISO = $country[1];
				echo "<td class='result'>$cISO</td>";
			}
			break;
		case 0:
			echo "<tr><td style='vertical-align:top' width=250><b>Ranking</b></td>";
			for($n=1;$n <= $numRows; $n++){
				echo "<td class='result'><b>$n</b></td>";
			}
			break;
		case 3:
			echo "<tr><td style='vertical-align:top'><b>Total Medals</b></td>";
			foreach($countryArray as $country){
				$cM = $country[2];
				echo "<td class='result'>$cM</td>";
			}
			break;
		case 4:
			echo "<tr><td style='vertical-align:top'><b>Cyclists</b></td>";
			foreach($countryArray as $country){
				$cyclists = "";
				foreach($cyclistArray as $cycl){
					if($cycl[0] == $country[1]){
						$cyclists .= $cycl[1] . "<br/>";
					}
				}
				echo "<td class='result'>$cyclists</td>";
			}
			break;
	}
}
echo "</table>";


function sortArrayGdpPop($a, $b){
	return strnatcmp(($a[3] * $a[4]) / 2, ($b[3] * $b[4]) / 2);
}
function sortArrayMedals($a, $b){
	return strnatcmp($b[2], $a[2]);
}

function rankingNumberGpdPop($gdp, $pop){
	$rankingNumber = $gdp * $pop / 2;
return $rankingNumber;	
}
?>