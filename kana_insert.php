<?php
$conn = oci_connect("p604244013","PloveJ1601","localhost:1521/orcl") or die ("error connect");
$act_id = $_POST['act_id'];
$act_name=$_POST['act_name'];
$score = $_POST['score'];
$act_type=$_POST['act_type'];
$act_detail = $_POST['act_detail'];
$act_status = $_POST['act_status'];
$sql = "INSERT INTO ACTIVITIES (ACTIVITIESID,ACTIVITIESNAME,SCORES,CATID,STATUS,DETAIL)VALUES ('$act_id','$act_name','$score','$act_type','$act_status','$act_detail')";
$objParse = oci_parse($conn, $sql);
$objExecute = oci_execute($objParse, OCI_DEFAULT);
if($objExecute){
    oci_commit($conn);
    echo "<script type='text/javascript'>";
        echo "alert('เพิ่มกิจกรรมสำเร็จ');";
        echo "window.location = 'add_kana.php'; ";
        echo "</script>";
}else{
    oci_rollback($conn);
    echo "<script>alert('เพิ่มกิจกรรมไม่สำเร็จ')</script>";
    echo "<script>alert('อาจมีบางอย่างผิดพลาด หรือ รหัสกิจกรรมซ้ำกัน')</script>";
    //  echo "<script>window.location = 'add_kana.php';</script>";
}
oci_close($conn);
?>
