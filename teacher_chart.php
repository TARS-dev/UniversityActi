<?php
error_reporting(E_ALL & ~E_NOTICE);
$id = $_POST["search"];
$id = $_GET["id"];
session_start();
$_SESSION['temp'] = $id;
$conn = oci_connect('p604244013', 'PloveJ1601', '//localhost/orcl');
$stid = oci_parse($conn, "SELECT * from show_t where studentid = $id");
oci_execute($stid);

?>
<table class="table table-striped">
<tr>
<th scope='col'style='text-align:center'>รหัสนักศึกษา</th>
        <th scope='col'style='text-align:center'>ชื่อนักศึกษา</th>
        <th scope='col'style='text-align:center'>คณะ</th>
        <th scope='col'style='text-align:center'>ชั้นปี</th>
        <th scope='col'style='text-align:center'>สถานะ</th>
        <th scope='col'style='text-align:center'>รหัสกิจกรรม</th>
        <th scope='col'style='text-align:center'>ชื่อกิจกรรม</th>
        <th scope='col'style='text-align:center'>คะแนน</th>
        <!-- <th scope='col'style='text-align:center'>รายงาน</th> -->
</tr>
<?php
  while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    ?>
        <tr>
          <td><?php echo $row['STUDENTID']; ?></td>
          <td><?php echo $row["STUDENTNAME"];?></td>
          <td><?php echo $row["KALE"]; ?></td>
          <td><?php echo $row["SCHOOLYEAR"]; ?></td>
          <td><?php echo $row["S_STATUS"]; ?></td>
          <td><?php echo $row["ACTIVITIESID"]; ?></td>
		  <td><?php echo $row["ACTIVITIESNAME"]; ?></td>
		  <td><?php echo $row["SCORES"]; ?></td>
          <?php if($row[10] == "") {?>
          <!-- <td align='center'><a href="delete.php?id=<?php echo $row['0'];?>" class="btn btn-danger">ยกเลิกกิจกรรม</a></td>   -->
          <?php
          }
          ?>
          <!-- <td><button name="add" id="add" data-toggle="modal" data-target="#addModal"></button></td> -->
            <?php
        }
        ?>
        </tr>
  <tr>
    <td></td>
  </tr>
</table>
<?php
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

<!-- <form action="" method="post">
<input type="text" name="search" placeholder = "Enter Student ID">
<input type="submit" name="submit" value="Search">
</form>  -->
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</head>
<body>
<!-- <strong><?php echo "Search : $id"; ?></strong> -->
<div id="chartContainer" style="height: 370px; width: 50%; margin-left:25%;"></div>
<div style="tranform:translate(50%,50%); margin-left:40%;">
<form method="post" action="export_teach.php?id=<?php echo $id;?>">	
	<a href='teach_show.php' class='btn btn-warning'>กลับไปหน้ารวมกิจกรรม</a>
	<a href="pdfTe.php" class="btn btn-success" style="float:left; margin-right:10px;">Download PDF</a>
     <input type="submit" name="export" class="btn btn-success" value="Save to excel" />
    </form>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  