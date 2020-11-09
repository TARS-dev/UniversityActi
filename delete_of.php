<?php
  include 'conn.php';
  $ra = $_GET['id'];
  $cat = $_GET['cat'];
  if($cat!=1){
    $stid = oci_parse($conn, "delete from official where idof='$ra' ");  
  }else{
    $stid = oci_parse($conn, "delete from students where studentid='$ra' ");
  }
    
    oci_execute($stid);
    if ( !oci_execute( $stid ) ) {
        echo 'Fail to delete';
    
    } else {
        $r = oci_commit( $conn );
        if ( !$r ) {
            $e = oci_error( $conn );
            trigger_error( htmlentities( $e['message'] ), E_USER_ERROR );
        } else {
            echo ( "<script LANGUAGE='JavaScript'>
                    window.alert('ลบผู้ใช้สำเร็จ');
                    window.location.href='show_all.php';
                    </script>" );
        }
    }
    ?>