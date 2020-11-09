<?php
error_reporting( error_reporting() & ~E_NOTICE ); 
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp',
    'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNewItalic.ttf',
                'B' =>  'THSarabunNewBold.ttf',
                'BI' => "THSarabunNewBoldItalic.ttf",
            ]
        ],
]);

ob_start(); // Start get HTML code
?>


<!DOCTYPE html>
<html>
<head>
<title>PDF</title>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<style>
body {
    font-family: sarabun;
}
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<?php
    session_start();
    $r = $_SESSION['temp'];
    $conn = oci_connect("p604244013","PloveJ1601","localhost:1521/orcl") or die ("error connect");
    $sql = "SELECT s.studentid,s.studentname,s.s_status,sum(c.countscore) as countscore
    FROM students s,counting c,category ca
    WHERE s.studentid = c.studentid
    AND c.catid = ca.catid
    group by s.studentid,s.studentname,s.s_status
    having count(c.catid) = (select count(catid) from category)
    order by countscore ASC";
    $query = oci_parse($conn,$sql);
    oci_execute($query);

    // require_once __DIR__ . '/vendor/autoload.php';

    // $mpdf = new \Mpdf\Mpdf([
    //   'default_font_size' => 18,
    //   'default_font' => 'saraban'
    // ]);
    ?>
    <a href="graduate.php" class='btn btn-warning'>กลับไปหน้าข้อมูลกิจกรรม</a>
<h1 style='text-align:center;'>ข้อมูลนักศึกษาที่สามารถขอจบการศึกษา</h1>
<table>
  <tr>
  <th scope='col'style='text-align:center'>รหัสนักศึกษา</th>
        <th scope='col'style='text-align:center'>ชื่อนักศึกษา</th>
        <th scope='col'style='text-align:center'>คะแนนกิจกรรม</th>
        <th scope='col'style='text-align:center'>สถานะ</th>
  </tr>
  <?php
    while (($row = oci_fetch_array($query,  OCI_BOTH)) != false) {
      ?>
          <tr>
          <td><?php echo $row["STUDENTID"];?></td>
            <td><?php echo $row["STUDENTNAME"];?></td>
            <td><?php echo $row["COUNTSCORE"]; ?></td>
            <td><?php echo $row["S_STATUS"]; ?></td>
            
            <?php
            }
            ?>
            <!-- <td><button name="add" id="add" data-toggle="modal" data-target="#addModal"></button></td> -->
              <?php
          
          ?>
  <!-- <tr>
    <td><?php $ac ?></td>
    <td><?php $ac ?></td>
    <td><?php $r['SCORES'] ?></td>
    <td><?php $r['APPILCATIONDATE'] ?></td>
    <td><?php $r['DATEACTIVITIES'] ?></td>
  </tr> -->
</table>
<a href="MyPDFin.pdf">Download PDF</a>
</div>
</body>
</html>






<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
$mpdf->Output("MyPDFin.pdf");
ob_end_flush();
?>