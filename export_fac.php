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
    $stid = oci_parse( $conn, "SELECT *
    FROM register, students 
    WHERE register.studentid = students.studentid AND 
    register.activitiesid = $idd" );
    oci_execute( $stid );
        $output .= '
   <table class="table" bordered="1"> 
                    <tr>  
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อนักศึกษา</th>
                    <th>คณะ</th>
                    <th>ชั้นปี</th>
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
     
                         <td>'.$row['STUDENTID'].'</td>  
                         <td>'.$row['STUDENTNAME'].'</td>  
                         <td>'.$row['KALE'].'</td>  
                         <td>'.$row['SCHOOLYEAR'].'</td>  
                    </tr>
   ';
        }
        $output .= '</table>';
        header( 'Content-Type: application/xls' );
        header( 'Content-Disposition: attachment; filename=download.xls' );
        echo $output;
    }
?>              