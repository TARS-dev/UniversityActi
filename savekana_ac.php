<?php
        $conn = oci_connect("p604244013","PloveJ1601","localhost:1521/orcl") or die ("error connect");
        $sql = "UPDATE activities SET ";
        $sql .="ACTIVITIESNAME = '".$_POST["act_name"]."' ";
        $sql .=",SCORES = '".$_POST["score"]."' ";
        $sql .=",DETAIL = '".$_POST["act_detail"]."' ";
        $sql .=",STATUS = '".$_POST["act_status"]."' ";
        $sql .="WHERE activitiesid = '".$_GET["activitiesid"]."' ";
        $objParse = oci_parse($conn, $sql);
        $objExecute = oci_execute($objParse, OCI_DEFAULT);
  if($objExecute)
  {
  	oci_commit($conn); //*** Commit Transaction ***//
    echo "<script type='text/javascript'>";
        echo "alert('อัพเดทสำเร็จ');";
        echo "window.location = 'edit_kana.php'; ";
        echo "</script>";
      }
  else
  {
  	oci_rollback($conn); //*** RollBack Transaction ***//
    echo "<script type='text/javascript'>";
        echo "alert('อัพเดทไม่สำเร็จ');";
        echo "window.location = 'edit_kana.php'; ";
        echo "</script>";
  	echo "Error Save [".$sql."]";
  }
  oci_close($conn);
  ?>