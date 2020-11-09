<?php
    $id = $_GET['STUDENTID'];
    include 'conn.php';
    $sql = "update students set s_status = 'Graduated' where studentid = '$id' ";
    $result1 = oci_parse( $conn, $sql );
        if(oci_execute( $result1 )){
            $r = oci_commit( $conn );
            if ( !$r ) {
                $e = oci_error( $conn );
                trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
            } else {
                echo ( "<script LANGUAGE='JavaScript'>
                            window.alert('อัพเดทสถานะสำเร็จ');
                            window.location.href='graduate.php';
                            </script>" );
            }
        }else{
            echo ( "<script LANGUAGE='JavaScript'>
                            window.alert('อัพเดทสถานะไม่สำเร็จ');
                            window.location.href='graduate.php';
                            </script>" );
        }
        
?>