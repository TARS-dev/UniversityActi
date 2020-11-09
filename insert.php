<?php
$id = $_POST['id'];
// $name = $_POST['name'];
// ac_detail;
include 'conn.php';
session_start();
$student = $_SESSION['studentid'];
$sql = "insert into register(appilcationdate,studentid,activitiesid) values (to_date(to_char(sysdate,'dd/mon/yyyy hh24:mi:ss'), 'dd/mm/yyyy hh24:mi:ss' ),$student,$id)";
$sql1 = "select COUNT(*) from register where studentid=$student and activitiesid=$id";
$result1 = oci_parse( $conn, $sql1 );
oci_execute( $result1 );
$row = oci_fetch_array( $result1 );
if ( $row[0]>='1' ) {
    echo 'ท่านได้ลงทะเบียนกิจกรรมไว้แล้ว';

} else {
    $result = oci_parse( $conn, $sql );
    $r = oci_execute( $result );
    $r = oci_commit( $conn );
    if ( !$r ) {
        $e = oci_error( $conn );
        trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
    } else {
        echo 'commit';
    }
}

?>