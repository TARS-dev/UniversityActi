<?php 
    $id = $_POST['id'];
    include 'conn.php';
    $sql = "select * from official where idof = $id";
    $result = oci_parse($conn,$sql);
    oci_execute($result);
    $row = oci_fetch_array($result);
    echo json_encode($row);
?>