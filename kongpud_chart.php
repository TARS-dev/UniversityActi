<?php

$conn = oci_connect('p604244013', 'PloveJ1601', '//localhost/orcl');

$total_stu = 0;

$stid = oci_parse($conn, "SELECT count(*) FROM students WHERE s_status = 'Graduated' ");
$r = oci_execute($stid);

$stid2 = oci_parse($conn, "SELECT count(*) FROM students WHERE s_status = 'none' ");
$r2 = oci_execute($stid2);

$stid3 = oci_parse($conn, "SELECT count(*) FROM students ");
$r3 = oci_execute($stid3);

$dataPoints = array();
$cnt = 10;

while ($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$total_stu = $item;
    }	
}

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item*100/$total_stu):' ',"indexLabel"=> "จบการศึกษา ($item)"));
        $cnt+=10;
    }	
}

while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item*100/$total_stu):' ',"indexLabel"=> "ยังไม่จบการศึกษา ($item)"));
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
		text: "Total Graduate"
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
<div id="chartContainer" style="height: 370px; width: 50%; margin-left:25%"></div>
<div style="tranform:translate(50%,50%); margin-left:41.7%;">
<form method="post" action="export_in.php">	
<a href="pdf_in.php" class="btn btn-success" style="float:left; margin-right:10px;">Download PDF</a>
     <input type="submit" name="export" class="btn btn-success" value="Save to excel" />
    </form>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  