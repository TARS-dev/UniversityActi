<?php
session_start();
$_SESSION['user'] = $_POST['username'];
$_SESSION['pass'] = $_POST['password'];
$r = $_SESSION['user'];
$rr = $_SESSION['pass'];
include 'conn.php';
$sql = "SELECT * FROM official WHERE IDOF= '$r'";
$result = oci_parse( $conn, $sql );
oci_execute( $result );
$row = oci_fetch_array( $result );
if ( $_SESSION['pass'] == $row['PASSWORDOF'] ) {
    $_SESSION['nameof'] = $row['NAMEUSEROF'];
    $_SESSION['cat']=$row['IDUSERCAT'];
    if($row['IDUSERCAT']==2){
        header( 'Location: teach_show.php' );
    }else if($row['IDUSERCAT']==3){
        header( 'Location: fac_show.php' );
    }else if($row['IDUSERCAT']==4){
        header( 'Location: incen.php' );
    }else if($row['IDUSERCAT']==5){
        header( 'Location: index_ad.php' );
    }
    // echo $_SESSION['studentid'];
    // header( 'Location: student_ac.php' );
} else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Login Failed');
    window.location.href='admin_log.html';
    </script>");
}
?>