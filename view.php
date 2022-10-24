<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex, nofollow" />
<title>Task 4</title>
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
div {
	text-align:center;
	margin-left:auto;
	margin-right:auto;
}

td.result {
	text-align:center;
	width: 250;
	vertical-align:top;
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
.initiallyHidden { display: none; }
.block { display: block; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">

function getResults(){
	var ammount = document.getElementById("ammount").value;
	var one = document.getElementById("one").value;
	var two = document.getElementById("two").value;
	var three = document.getElementById("three").value;
	var four = document.getElementById("four").value;
	var sorting = document.getElementById("sorting").value;
	$("#result").load("result.php", {values:ammount,ISO_id1:one,ISO_id2:two,ISO_id3:three,ISO_id4:four,sorting:sorting});
};
function ammountLookUp(ammount){
	switch(Number(ammount)){
	case 2:
		document.getElementById("threeRow").style.display = "none";
		document.getElementById("fourRow").style.display = "none";
		document.getElementById("three").value = "";
		document.getElementById("four").value = "";
		break;
	case 3:
		document.getElementById("threeRow").style.display = "inline";
		document.getElementById("fourRow").style.display = "none";
		document.getElementById("four").value = "";
		break;
	case 4:
		document.getElementById("threeRow").style.display = "inline";
		document.getElementById("fourRow").style.display = "inline";
		break;
	}
};

</script>
</head>
<body>
<h3 class="center">COA123 - Web Programming</h3>
<h2 class="center">Individual Coursework - Olympic Cyclists</h2>
<h1 class="center">Task 4 - (view.php)</h1>
<br />
<!--code to get the ammounf of choices-->
<div style="width: 420px; height:20px">
<p style="display: inline">Choose the ammount of countries to compare: </p>
<select id="ammount" onchange="ammountLookUp(this.value)">
	<option value=2 selected="selected">2</option>
	<option value=3>3</option>
	<option value=4>4</option>
</select>
</div>
<div>
<p style="display: inline">How do you want to sort the results</p>
<select id="sorting">
	<option value ="medals">Ammount of Medals</option>
	<option value ="gpdPop">Gpd / population</option>
</select>
</div>
<br />
<table border=1 name="inputs">
	<tr>
		<td>ISO_id 1</td>
		<td><input type="text" name="one" class="larger" id="one"/></td>
	</tr>
	<tr>
		<td>ISO_id 2</td>
		<td><input type="text" name="two" class="larger" id="two"/></td>
	</tr>
	<tr class="initiallyHidden" id="threeRow">
		<td>ISO_id 3</td>
		<td><input type="text" name="three" class="larger" id="three"/></td>
	</tr>
	<tr class="initiallyHidden" id="fourRow">
		<td>ISO_id 4</td>
		<td><input type="text" name="four" class="larger" id="four"/></td>
	</tr>
	<tr id="button">
		<td></td>
		<td align="center"><button type="button" onclick="getResults()">Sumbit</button></td>
	</tr>
</table>
<br />

<div id="result"></div>
</body>
</html>