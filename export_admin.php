<?php
//export.php
error_reporting( error_reporting() & ~E_NOTICE ); 
include 'conn.php';
session_start();
// $idd = $_SESSION["studentid"];
$output = '';
if ( isset( $_POST['export'] ) )
 {
    $stid = oci_parse( $conn, "SELECT * FROM official" );
    oci_execute( $stid );
        $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th>ชื่อผู้ใช้ระบบ</th>
                    <th>ชื่อผู้ใช้ระบบ</th>
                    <th>ประเภทผู้ใช้ระบบ</th>
                    </tr>';
  while ( ( $row = oci_fetch_array( $stid, OCI_BOTH ) ) != false ) 
 {
     if($row['IDUSERCAT']==2){
         $cat = 'อาจารย์';
     }else if($row['IDUSERCAT']==3){
        $cat = 'บุคลากรคณะ';
     }else if($row['IDUSERCAT']==4){
        $cat = 'บุคลากรกองพัฒฯ';
     }else if($row['IDUSERCAT']==5){
        $cat = 'ผู้ดูแลระบบ';
     }
            $output .= '
    <tr>  
                         <td>'.$row['IDOF'].'</td>  
                         <td>'.$row['NAMEUSEROF'].'</td>
                         <td>'.$cat.'</td>  
                    </tr>
   ';
        }
        $output .= '</table>';
        // header( 'Content-Type: application/xls' );
        // header( 'Content-Disposition: attachment; filename=download.xls' );
        echo $output;
    }
    $outputt = '';
if ( isset( $_POST['export'] ) )
 {
    $stid = oci_parse( $conn, "SELECT * FROM students" );
    oci_execute( $stid );
        $outputt .= '<br>
   <table class="table" bordered="1">  
                    <tr>  
                    <th>ชื่อผู้ใช้ระบบ</th>
                    <th>ชื่อผู้ใช้ระบบ</th>
                    <th>ประเภทผู้ใช้ระบบ</th>
                    </tr>';
  while ( ( $row = oci_fetch_array( $stid, OCI_BOTH ) ) != false ) 
 {
     if($row['IDUSERCAT']==2){
         $cat = 'อาจารย์';
     }else if($row['IDUSERCAT']==3){
        $cat = 'บุคลากรคณะ';
     }else if($row['IDUSERCAT']==4){
        $cat = 'บุคลากรกองพัฒฯ';
     }else if($row['IDUSERCAT']==5){
        $cat = 'ผู้ดูแลระบบ';
     }else if($row['IDUSERCAT']==1){
        $cat = 'นักศึกษา';
     }
            $outputt .= '
    <tr>  
                         <td>'.$row['STUDENTID'].'</td>  
                         <td>'.$row['STUDENTNAME'].'</td>
                         <td>'.$cat.'</td>  
                    </tr>
   ';
        }
        $outputt .= '</table>';
        header( 'Content-Type: application/xls' );
        header( 'Content-Disposition: attachment; filename=download.xls' );
        echo $outputt;
    }
?>