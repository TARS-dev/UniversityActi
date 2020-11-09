<?php
$id = $_POST['id'];
$name = $_POST['name'];
$score = $_POST['score'];
$cat = $_POST['catname'];
$state= $_POST['state'];
$de = $_POST['de'];
include 'conn.php';
session_start();
if($id!=''){
    $sql1 = "update activities set activitiesname = '$name',scores= '$score', detail='$de', status='$state', catid='$cat' where activitiesid = $id ";
}
$result1 = oci_parse( $conn, $sql1 );
oci_execute( $result1 );

if(oci_execute( $result1 )){
    echo "Complete";
}else{
    echo "Error";
}
// $row = oci_fetch_array( $result1 );
//     $result = oci_parse( $conn, $sql1 );
//     $r = oci_execute( $result );
//     $r = oci_commit( $conn );
//     if ( !$r ) {
//         $e = oci_error( $conn );
//         trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
//     } else {
//         echo 'commit';
//     }

?>