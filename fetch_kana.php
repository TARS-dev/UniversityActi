<?php 
    $id = $_POST['id'];
    include 'conn.php';
    $sql = "SELECT * from activities a,category c where  a.activitiesid=$id";
    $result = oci_parse($conn,$sql);
    oci_execute($result);
    $row = oci_fetch_array($result);
    echo json_encode($row);
?>