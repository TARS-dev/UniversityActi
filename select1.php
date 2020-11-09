<?php 
    $id = $_POST['id'];
    include 'conn.php';
    $sql = "select * from activities a,category c where a.activitiesid = $id AND a.catid=c.catid";
    $result = oci_parse($conn,$sql);
    oci_execute($result);
    $row = oci_fetch_array($result);
    echo json_encode($row);
?>