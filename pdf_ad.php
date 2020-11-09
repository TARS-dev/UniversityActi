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
    $sql = "SELECT * from students";
    $sql1 = "SELECT * from official";
    $query = oci_parse($conn,$sql);
    $query1 = oci_parse($conn,$sql1);
    oci_execute($query);
    oci_execute($query1);

    // require_once __DIR__ . '/vendor/autoload.php';

    // $mpdf = new \Mpdf\Mpdf([
    //   'default_font_size' => 18,
    //   'default_font' => 'saraban'
    // ]);
    ?>
    <a href="show_all.php" class='btn btn-warning'>กลับไปหน้าข้อมูลกิจกรรม</a>
<h1 style='text-align:center;'>ข้อมูลบุคลากร</h1>
<table>
  <tr>
  <th scope='col'style='text-align:center'>ชื่อเข้าใช้ระบบ</th>
        <th scope='col'style='text-align:center'>ชื่อบุคลากร</th>
        <th scope='col'style='text-align:center'>ประเภทบุคลากร</th>
  </tr>
  <?php
    while (($row = oci_fetch_array($query,  OCI_BOTH)) != false) {
      ?>
          <tr>
              <td><?php echo $row["STUDENTID"];?></td>
              <td><?php echo $row["STUDENTNAME"];?></td>
              <td><?php echo "นักศึกษา";?></td>
            <?php
            }
            while (($row = oci_fetch_array($query1,  OCI_BOTH)) != false) {
                ?>
                    <tr>
                        <td><?php echo $row["IDOF"];?></td>
                        <td><?php echo $row["NAMEUSEROF"];?></td>
                        <?php
                        if($row['IDUSERCAT']==2){
                            echo "<td>อาจารย์</td>";
                        }elseif($row['IDUSERCAT']==3){
                            echo "<td>บุคลากรคณะ</td>";
                        }elseif($row['IDUSERCAT']==4){
                            echo "<td>บุคลากรกองพัฒฯ</td>";
                        }elseif($row['IDUSERCAT']==5){
                            echo "<td>ผู้ดูแลระบบ</td>";
                        }?>
                      <?php
                      }
            ?>
  <!-- <tr>
    <td><?php $ac ?></td>
    <td><?php $ac ?></td>
    <td><?php $r['SCORES'] ?></td>
    <td><?php $r['APPILCATIONDATE'] ?></td>
    <td><?php $r['DATEACTIVITIES'] ?></td>
  </tr> -->
</table>
<a href="MyPDFad.pdf">Download PDF</a>
</div>
</body>
</html>






<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
$mpdf->Output("MyPDFad.pdf");
ob_end_flush();
?>