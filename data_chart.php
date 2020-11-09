<?php
    header('Content-Type: application/json');
    include 'conn.php';
    session_start();
    $r = $_SESSION['studentid'];
    $sql = "SELECT c.catname,o.countscore FROM category c,counting o where o.studentid = '$r' and o.catid=c.catid ";
    
    $result = oci_parse($conn,$sql);
    
    oci_execute($result);
    
    $data = array();
    while (($row = oci_fetch_array($result, OCI_BOTH)) != false){
        $data[] = $row;
    }
    echo json_encode($data);
?>