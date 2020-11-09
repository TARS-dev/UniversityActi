<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style media="screen">
  body{
    margin: 0;
  padding: 0;
  }
  </style>
  <body >

    <?php
    session_start();
    $r = $_SESSION['user'];
    $conn = oci_connect("p604244013","PloveJ1601","localhost:1521/orcl") or die ("error connect");
    $sql = "SELECT * FROM register r,activities a WHERE r.activitiesid = a.activitiesid AND r.studentid = '$r'";
    $query = oci_parse($conn,$sql);
    oci_execute($query);

    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf([
      'default_font_size' => 18,
      'default_font' => 'saraban'
    ]);

    while ($r = oci_fetch_array($query)) {
      $top = '
      '. $r['ACTIVITIESID'].'
      '. $r['ACTIVITIESNAME'].'
      '. $r['SCORES'].'
      '.$r['ACTIVITIESNAME'].'
      '.$r['APPILCATIONDATE'].'
      '.$r['DATEACTIVITIES'].' ';
    $mpdf->WriteHTML($top);
    }
         $mpdf->Output();

      ?>
  </body>
</html>
