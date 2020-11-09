<?php
//export.php
error_reporting( error_reporting() & ~E_NOTICE ); 
include 'conn.php';
session_start();
$idd = $_SESSION["studentid"];
$output = '';
if ( isset( $_POST['export'] ) )
 {
    $stid = oci_parse( $conn, "SELECT * FROM activities a,register r where r.studentid = $idd and r.activitiesid=a.activitiesid" );
    oci_execute( $stid );
        $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th>รหัสกิจกรรม</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>คะแนนกิจกรรม</th>
                    <th>ประเภทกิจกรรม</th>
                    <th>วันที่สมัครกิจกรรม</th>
                    <th>วันที่ยืนยันกิจกรรม</th>
                    </tr>';
  while ( ( $row = oci_fetch_array( $stid, OCI_BOTH ) ) != false ) 
 {
     if($row['CATID']==1){
         $cat = 'กิจกรรมส่วนกลาง';
     }else if($row['CATID']==2){
        $cat = 'กิจกรรมบังคับคณะ';
     }else{
        $cat = 'กิจกรรมเลือก';
     }
            $output .= '
    <tr>  
                         <td>'.$row['ACTIVITIESID'].'</td>  
                         <td>'.$row['ACTIVITIESNAME'].'</td>  
                         <td>'.$row['SCORES'].'</td>
                         <td>'.$cat.'</td>
                         <td>'.$row['APPILCATIONDATE'].'</td>
                         <td>'.$row['DATEACTIVITIES'].'</td>
                    </tr>
   ';
        }
        $output .= '</table>';
        header( 'Content-Type: application/xls' );
        header( 'Content-Disposition: attachment; filename=download.xls' );
        echo $output;
    }
?>