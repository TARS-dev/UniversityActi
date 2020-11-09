<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(0);

$act_id = $_GET["id"];
session_start();
$_SESSION['temp'] = $act_id;
// echo "Search : $act_id";

$conn = oci_connect('p604244013', 'PloveJ1601', '//localhost/orcl');

$stid = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 1 AND students.kale = 'IT' AND register.activitiesid = $act_id");
$r = oci_execute($stid);

$stid2 = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 2 AND students.kale = 'IT' AND register.activitiesid = $act_id");
$r2 = oci_execute($stid2);

$stid3 = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 3 AND students.kale = 'IT' AND register.activitiesid = $act_id");
$r3 = oci_execute($stid3);

$stid4 = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 4 AND students.kale = 'IT' AND register.activitiesid = $act_id");
$r4 = oci_execute($stid4);

$dataPoints = array();
$cnt = 10;

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี1($item)"));
        $cnt+=10;
    }	
}

while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี2($item)"));
        $cnt+=10;
    }	
}

while ($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี3($item)"));
        $cnt+=10;
    }	
}

while ($row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
			array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี4($item)"));
        $cnt+=10;
    }	
}

oci_free_statement($stid);
oci_close($conn);
	
?>
<!DOCTYPE HTML>
<html>
<head>  

<!-- <form action="" method="post">
<input type="text" name="search" placeholder = "Activity ID">
<input type="submit" name="submit" value="Search">
</form>  -->

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Total Students"
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</head>
<body>
<strong><?php echo "Search : $act_id"; ?></strong>
<div id="chartContainer" style="height: 370px; width: 50%;"></div>
<div style="tranform:translate(50%,50%); margin-left:30%;">
<form method="post" action="export_fac.php?id=<?php echo $act_id;?>">	
	<a href='kana_ac.php' class='btn btn-warning'>กลับไปหน้ารวมกิจกรรม</a>
    <a href="pdffac.php" class="btn btn-success" style="float:left; margin-right:10px;">Download PDF</a>
     <input type="submit" name="export" class="btn btn-success" value="Save to excel" />
    </form>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  