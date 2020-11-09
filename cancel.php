<?php
    include 'conn.php';
    $ids = $_GET['ids'];
    $ida = $_GET['ida'];
    $sql1 = "UPDATE register set dateactivities = SYSDATE where studentid = $ids and activitiesid = $ida ";
    $result1 = oci_parse( $conn, $sql1 );
    oci_execute( $result1 );
    if ( !oci_execute( $result1 ) ) {
        echo 'Fail to delete';
    
    } else {
        $r = oci_commit( $conn );
        if ( !$r ) {
            $e = oci_error( $conn );
            trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
        } else {
            echo ( "<script LANGUAGE='JavaScript'>
                    window.alert('ยืนยันกิจกรรมสำเร็จ');
                    window.location.href='con_kana.php';
                    </script>" );
        }
    }
?>