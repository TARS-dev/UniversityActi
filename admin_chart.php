<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(0);

// $act_id = $_POST["search"];
// $faculty = $_POST["faculty"];
// echo "Search : $act_id ";
// echo $faculty;

$conn = oci_connect('p604244013', 'PloveJ1601', '//localhost/orcl');
// if($faculty==ALL){
    $stid = oci_parse($conn, "SELECT count(*) FROM students");
    $r = oci_execute($stid);

    $stid2 = oci_parse($conn, "SELECT count(*) FROM official WHERE idusercat = 2");
    $r2 = oci_execute($stid2);

    $stid3 = oci_parse($conn, "SELECT count(*) FROM official WHERE idusercat = 3");
    $r3 = oci_execute($stid3);

    $stid4 = oci_parse($conn, "SELECT count(*) FROM official WHERE idusercat = 4");
    $r4 = oci_execute($stid4);

    $stid5 = oci_parse($conn, "SELECT count(*) FROM official WHERE idusercat = 5");
    $r5 = oci_execute($stid4);

    $dataPoints = array();
    $cnt = 10;

    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
                array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "นักศึกษา($item)"));
            $cnt+=10;
        }	
    }

    while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
                array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "อาจารย์($item)"));
            $cnt+=10;
        }	
    }

    while ($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
                array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "บุคลากรคณะ($item)"));
            $cnt+=10;
        }	
    }

    while ($row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
                array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "บุคลากรกองพัฒฯ($item)"));
            $cnt+=10;
        }	
    }

    while ($row = oci_fetch_array($stid5, OCI_ASSOC+OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
                array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ผู้ดูแลระบบ($item)"));
            $cnt+=10;
        }	
    }
// }
// else{
//     $stid = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 1 AND students.kale = '$faculty' AND register.activitiesid = $act_id");
//     $r = oci_execute($stid);

//     $stid2 = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 2 AND students.kale = '$faculty' AND register.activitiesid = $act_id");
//     $r2 = oci_execute($stid2);

//     $stid3 = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 3 AND students.kale = '$faculty' AND register.activitiesid = $act_id");
//     $r3 = oci_execute($stid3);

//     $stid4 = oci_parse($conn, "SELECT count(*) FROM register, students WHERE register.studentid = students.studentid AND students.schoolyear = 4 AND students.kale = '$faculty' AND register.activitiesid = $act_id");
//     $r4 = oci_execute($stid4);

//     $dataPoints = array();
//     $cnt = 10;

//     while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
//         foreach ($row as $item) {
//                 array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี1($item)"));
//             $cnt+=10;
//         }	
//     }

//     while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
//         foreach ($row as $item) {
//                 array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี2($item)"));
//             $cnt+=10;
//         }	
//     }

//     while ($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)) {
//         foreach ($row as $item) {
//                 array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี3($item)"));
//             $cnt+=10;
//         }	
//     }

//     while ($row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS)) {
//         foreach ($row as $item) {
//                 array_push($dataPoints,array("x"=>$cnt,"y"=>$item?htmlentities($item):' ',"indexLabel"=> "ปี4($item)"));
//             $cnt+=10;
//         }	
//     }
// }



oci_free_statement($stid);
oci_close($conn);
	
?>
<!DOCTYPE HTML>
<html>
<head>  

<!-- <form action="" method="post">
<input type="text" name="search" placeholder = "Activity ID">
<select id="faculty" name="faculty">
  <option value="ALL">ทั้งหมด</option>
  <option value="EDU">ครุศาสตร์</option>
  <option value="HUM">มนุษย์ศาสตร์และสังคมศาสตร์</option>
  <option value="ENGRG">วิศวกรรมศาสตร์</option>
  <option value="SCI">วิทยาศาสตร์</option>
  <option value="MAN">วิทยาการจัดการ</option>
  <option value="IT">เทคโนโลยีสารสนเทศ</option>
  <option value="AGR">เทคโนโลยีการเกษตร</option>
  <option value="NUR">พยาบาลศาสตร์</option>
</select>
<input type="submit" name="submit" value="Search">
</form>  -->

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
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
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 50%; margin-left:25%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  