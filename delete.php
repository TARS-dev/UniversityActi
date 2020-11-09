<?php
include 'conn.php';
$id = $_GET['id'];
$sql = 'delete from register where activitiesid='.$id;
$result = oci_parse( $conn, $sql );
oci_execute( $result );
if ( !oci_execute( $result ) ) {
    echo 'Fail to delete';

} else {
    $r = oci_commit( $conn );
    if ( !$r ) {
        $e = oci_error( $conn );
        trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
    } else {
        echo ( "<script LANGUAGE='JavaScript'>
                window.alert('ลบกิจกรรมสำเร็จ');
                window.location.href='myData_ac.php';
                </script>" );
    }
}
?>