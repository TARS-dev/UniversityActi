<?php
include 'conn.php';
session_start();
$id = $_SESSION['user'];
$old = $_POST['old'];
$new = $_POST['new'];
$neww = $_POST['neww'];
$sql = "select passwordof from official where idof= '$id' ";
$result = oci_parse( $conn, $sql );
oci_execute( $result );
while ( ( $row = oci_fetch_array( $result, OCI_BOTH ) ) != false )
if ( $row['PASSWORDOF'] == $old ) {
    echo 'รหัสเดิมถูก';
    if ( $new == $neww ) {
        echo 'รหัสใหม่ถูก';
        $sql1 = "update official set passwordof = $new where idof= '$id' ";
        $result1 = oci_parse( $conn, $sql1 );
        oci_execute( $result1 );
        $r = oci_commit( $conn );
        if ( !$r ) {
            $e = oci_error( $conn );
            trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
        } else {
            echo  ( "<script LANGUAGE='JavaScript'>
                        window.alert('อัพเดทรหัสผ่านสำเร็จ');
                        window.location.href='change_t.php';
                        </script>" );
        }
    }else{
        echo ( "<script LANGUAGE='JavaScript'>
                        window.alert('อัพเดทรหัสผ่านไม่สำเร็จ');
                        window.location.href='change_t.php';
                        </script>" );
    }
}else{
    echo ( "<script LANGUAGE='JavaScript'>
                        window.alert('อัพเดทรหัสผ่านไม่สำเร็จ');
                        window.location.href='uppass.php';
                        </script>" );
}
?>