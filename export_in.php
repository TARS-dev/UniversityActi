<?php
//export.php
error_reporting( error_reporting() & ~E_NOTICE ); 
include 'conn.php';
session_start();
// $idd = $_SESSION["studentid"];
// $idd = $_GET["id"];
$output = '';
if ( isset( $_POST['export'] ) )
 {
    $stid = oci_parse( $conn, "SELECT s.studentid,s.studentname,s.s_status,sum(c.countscore) as countscore
    FROM students s,counting c,category ca
    WHERE s.studentid = c.studentid
    AND c.catid = ca.catid
    group by s.studentid,s.studentname,s.s_status
    having count(c.catid) = (select count(catid) from category)
    order by countscore ASC" );
    oci_execute( $stid );
        $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อนักศึกษา</th>
                    <th>สถานะ</th>
                    <th>คะแนนรวม</th>
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
                         <td>'.$row['S_STATUS'].'</td>  
                         <td>'.$row['COUNTSCORE'].'</td>  
                    </tr>
   ';
        }
        $output .= '</table>';
        header( 'Content-Type: application/xls' );
        header( 'Content-Disposition: attachment; filename=download.xls' );
        echo $output;
    }
?>