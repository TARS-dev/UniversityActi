<?php

$id = $_SESSION['user'];

$conn = oci_connect('p604244013', 'PloveJ1601', '//localhost/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the statement
$stid = oci_parse($conn, "SELECT countscore FROM counting where studentid = '$id' ");
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Fetch the results of the query
$dataPoints = array();
$cnt = 10;

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($cnt==10){
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item/20*100):' ',"indexLabel"=> "ส่วนกลาง $item/20"));
		}elseif ($cnt==20) {
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item/40*100):' ',"indexLabel"=> "คณะ $item/40"));
		}elseif ($cnt==30) {
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item/40*100):' ',"indexLabel"=> "เลือก $item/40"));
		}
        $cnt+=10;
    }	
}

// oci_free_statement($stid);
// oci_close($conn);
	
?>
<!DOCTYPE HTML>
<html>
<head>  

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Total Activity"
	},
	data: [{
		type: "pie", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 480px; width: 50%; tranform:translate(50%,50%); margin-left:25%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  