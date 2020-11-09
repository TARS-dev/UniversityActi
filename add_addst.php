<?php
include 'conn.php';
$id = $_POST['idof'] ;
$type = $_POST['type'];
$name = $_POST['name'];
$pass = $_POST['pass'];
$state = $_POST['status'];
$ka = $_POST['kale'];
$year = $_POST['year'];
$sql = "INSERT INTO students VALUES ('$id','$name','$state','$pass','$type','$ka','$year')";
$objParse = oci_parse($conn, $sql);
$objExecute = oci_execute($objParse, OCI_DEFAULT);
if($objExecute){
    oci_commit($conn);
    echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลนักศึกษาสำเร็จ');";
        echo "window.location = 'add_st.php'; ";
        echo "</script>";
}else{
    oci_rollback($conn);
    echo "<script>alert('เพิ่มข้อมูลนักศึกษาไม่สำเร็จ')</script>";
    echo "<script>alert('อาจมีบางอย่างผิดพลาด หรือ รหัสกิจกรรมซ้ำกัน')</script>";
     echo "<script>window.location = 'add_st.php';</script>";
}
oci_close($conn);
?>
