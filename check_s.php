<?php
session_start();
$_SESSION['user'] = $_POST['username'];
$_SESSION['pass'] = $_POST['password'];
$r = $_SESSION['user'];
$rr = $_SESSION['pass'];
include 'conn.php';
$sql = "SELECT * FROM students WHERE studentid= '$r'";
$result = oci_parse( $conn, $sql );
oci_execute( $result );
$row = oci_fetch_array( $result );
if ( $_SESSION['pass'] == $row['PASSBRITH'] ) {
    $_SESSION['name'] = $row['STUDENTNAME'];
    $_SESSION['studentid'] = $row['STUDENTID'];
    $_SESSION['cat']= $row['IDUSERCAT'];
    // echo $_SESSION['cat'];
    // echo $_SESSION['studentid'];
    header( 'Location: student_ac.php' );
} else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Login Failed');
    window.location.href='login.html';
    </script>");
}
?>