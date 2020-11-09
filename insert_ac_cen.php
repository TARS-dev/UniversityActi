<?php
include 'conn.php';
$id = $_POST['act_id'] ;
$name = $_POST['act_name'];
$score = $_POST['act_score'];
$cat = $_POST['act_type'];
$sta = $_POST['act_sta'];
$de = $_POST['act_de'];

$sql = "INSERT INTO ACTIVITIES (ACTIVITIESID,ACTIVITIESNAME,SCORES,CATID,STATUS,DETAIL)VALUES ('$id','$name','$score','$cat','$sta','$de')";
$objParse = oci_parse($conn, $sql);
$objExecute = oci_execute($objParse, OCI_DEFAULT);
if($objExecute){
    oci_commit($conn);
    echo "<script type='text/javascript'>";
        echo "alert('เพิ่มกิจกรรมสำเร็จ');";
        echo "window.location = 'insert_cen.php'; ";
        echo "</script>";
}else{
    oci_rollback($conn);
    echo "<script>alert('เพิ่มกิจกรรมไม่สำเร็จ')</script>";
    echo "<script>alert('อาจมีบางอย่างผิดพลาด หรือ รหัสกิจกรรมซ้ำกัน')</script>";
     echo "<script>window.location = 'insert_cen.php';</script>";
}
oci_close($conn);
?>
