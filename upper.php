<?php
include 'conn.php';
session_start();
$r = $_SESSION['studentid'];
$name = $_POST['name'];
$sql = "update students set studentname = '$name' where studentid=$r";
$result = oci_parse( $conn, $sql );
oci_execute( $result );
if ( !oci_execute( $result ) ) {
    echo 'Fail to update';

} else {
    $r = oci_commit( $conn );
    if ( !$r ) {
        $e = oci_error( $conn );
        trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
    } else {
        echo ( "<script LANGUAGE='JavaScript'>
                window.alert('อัพเดทข้อมูลสำเร็จ');
                window.location.href='mineData.php';
                </script>" );
    }
}
?>