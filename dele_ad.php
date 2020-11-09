<?php
  include 'conn.php';
  $ra = $_GET['id'];
    $stid = oci_parse($conn, "delete from activities where activitiesid='$ra' ");
    oci_execute($stid);
    if ( !oci_execute( $stid ) ) {
        echo 'Fail to delete';
    
    } else {
        $r = oci_commit( $conn );
        if ( !$r ) {
            $e = oci_error( $conn );
            trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
        } else {
            echo ( "<script LANGUAGE='JavaScript'>
                    window.alert('ลบกิจกรรมสำเร็จ');
                    window.location.href='index_ad.php';
                    </script>" );
        }
    }
    ?>