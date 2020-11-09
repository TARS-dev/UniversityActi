<?php
include 'conn.php';
$id = $_POST['idof'] ;
$type = $_POST['type'];
$name = $_POST['name'];
$pass = $_POST['pass'];

$sql = "INSERT INTO official VALUES ('$id','$type','$name','$pass')";
$objParse = oci_parse($conn, $sql);
$objExecute = oci_execute($objParse, OCI_DEFAULT);
if($objExecute){
    oci_commit($conn);
    echo "<script type='text/javascript'>";
        echo "alert('เพิ่มกิจกรรมสำเร็จ');";
        echo "window.location = 'add_of.php'; ";
        echo "</script>";
}else{
    oci_rollback($conn);
    echo "<script>alert('เพิ่มกิจกรรมไม่สำเร็จ')</script>";
    echo "<script>alert('อาจมีบางอย่างผิดพลาด หรือ รหัสกิจกรรมซ้ำกัน')</script>";
     echo "<script>window.location = 'add_of.php';</script>";
}
oci_close($conn);
?>
