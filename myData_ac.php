<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Activity</title>
<link rel="stylesheet" href="acti.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <?php error_reporting( error_reporting() & ~E_NOTICE ); ?>
</head>
<body id="body">

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="student_ac.php">หน้ารวมกิจกรรม</a>
  <a href="central_ac.php"  >กิจกรรมส่วนกลาง</a>
  <a href="faculty_ac.php" >กิจกรรมบังคับคณะ</a>
  <a href="choose_ac.php ">กิจกรรมเลือก</a>
  <a href="myData_ac.php" style="color: #640200;
   background-color: #F5DD37;">ข้อมูลการทำกิจกรรม</a>
  <a href="mineData.php">ข้อมูลส่วนตัว</a>
  <a href="uppass.php">แก้ไขรหัสผ่าน</a>
</div>
<div id="box">
  <img src="father.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["name"];
  $idd = $_SESSION["studentid"];
?></H2>
<a href="logout.php" style="color:white; " class='btn btn-danger'>Log Out</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
  <h2>ข้อมูลการลงทะเบียนกิจกรรมของคุณ</h2>
  <br><br><br>
  <?php
  include 'conn.php';
$stid = oci_parse($conn, "SELECT * FROM activities a,register r where r.studentid = $idd and r.activitiesid=a.activitiesid");
oci_execute($stid);

?>
<table class="table table-striped">
<tr>
  <th>รหัสกิจกรรม</th>
  <th>ชื่อกิจกรรม</th>
  <th>คะแนนกิจกรรม</th>
  <th>ประเภทกิจกรรม</th>
  <th>วันที่สมัครกิจกรรม</th>
  <th>วันที่ยืนยันกิจกรรม</th>
  <th>ลบกิจกรรม</th>
</tr>
<?php
  while (($row = oci_fetch_array($stid, OCI_NUM)) != false) {
    ?>
        <tr>
          <td><?php echo $row[0]; ?></td>
          <td><?php echo $row[1];?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php if($row[3]==1){ echo "กิจกรรมส่วนกลาง";}elseif($row[3]==2) { echo "กิจกรรมบังคับคณะ";}else{echo "กิจกรรมเลือก";}  ?></td>
          <td><?php echo $row[7]; ?></td>
          <td><?php echo $row[10]; ?></td>
          <?php if($row[10] == "") {?>
          <td align='center'><a href="delete.php?id=<?php echo $row['0'];?>" class="btn btn-danger">ยกเลิกกิจกรรม</a></td>  
          <?php
          }
          ?>
          <!-- <td><button name="add" id="add" data-toggle="modal" data-target="#addModal"></button></td> -->
            <?php
        }
        ?>
        </tr>
  <tr>
    <td></td>
  </tr>
</table>
<?php
// include 'canvas_chart.php';
include 'student_chart.php';
?>

<div style="tranform:translate(50%,50%); margin-left:41.5%;">
<a href="pdfSt.php" class="btn btn-success" style="float:left; margin-right:10px;">Download PDF</a>
<form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Save to excel" />
    </form>
</div>

<?php
oci_free_statement($stid);
oci_close($conn);

?>
  
</div>
<?php require 'viewModal.php' ?>
<?php require 'insertModal.php'?>

<script>
$(document).ready(function(){
  $('#insert-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url:"insert.php",
      method:"post",
      data:$('#insert-form').serialize(),
      beforeSend:function(){
        $('#insert').val("insert...");
      },
      success:function(data){
        $('#insert-form')[0].reset();
        $('#addModal').modal('hide');
      }
    });
  });
$('.appli_data').click(function(){
    var uid=$(this).attr("id");
    $.ajax({
      url:"select1.php",
      method:"post",
      data:{id:uid},
      dataType:"json",
      beforeSend:function(){
        $('#insert').val("สมัครกิจกรรม");
      },
      success:function(data){
        $('#id').val(data.ACTIVITIESID)
        $('#name').val(data.ACTIVITIESNAME);
        $('#catname').val(data.CATNAME);
        $('#score').val(data.SCORES);
        $('#de').val(data.DETAIL);
        $('#addModal').modal('show');
      }
    });
  });
});
</script>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</body>
</html> 
