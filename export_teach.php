<?php
//export.php
error_reporting( error_reporting() & ~E_NOTICE ); 
include 'conn.php';
session_start();
// $idd = $_SESSION["studentid"];
$idd = $_GET["id"];
$output = '';
if ( isset( $_POST['export'] ) )
 {
    $stid = oci_parse( $conn, "SELECT * from show_t where studentid = $idd" );
    oci_execute( $stid );
        $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อนักศึกษา</th>
                    <th>คณะ</th>
                    <th>ชั้นปี</th>
                    <th>สถานะ</th>
                    <th>รหัสกิจกรรม</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>คะแนน</th>
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
                         <td>'.$row['KALE'].'</td>  
                         <td>'.$row['SCHOOLYEAR'].'</td>  
                         <td>'.$row['S_STATUS'].'</td>  
                         <td>'.$row['ACTIVITIESID'].'</td>
                         <td>'.$row['ACTIVITIESNAME'].'</td>
                         <td>'.$row['SCORES'].'</td>
                    </tr>
   ';
        }
        $output .= '</table>';
        header( 'Content-Type: application/xls' );
        header( 'Content-Disposition: attachment; filename=download.xls' );
        echo $output;
    }
?>