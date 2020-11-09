<?php 
include 'conn.php';
$id = $_GET["id"];
$sql = oci_parse($conn,"delete from activities where activitiesid=".$id);
oci_execute($sql);
if ( !oci_execute( $sql ) ) {
    echo 'Fail to delete';

} else {
    $r = oci_commit( $conn );
    if ( !$r ) {
        $e = oci_error( $conn );
        trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
    } else {
        echo ( "<script LANGUAGE='JavaScript'>
                window.alert('ลบกิจกรรมสำเร็จ');
                window.location.href='incen.php';
                </script>" );
    }
}
?>