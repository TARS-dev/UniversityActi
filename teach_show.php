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
  <?php error_reporting( error_reporting() & ~E_NOTICE ); ?>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="teach_show.php" style="color: #640200;
   background-color: #F5DD37;">ข้อมูลกิจกรรมนักศึกษา</a>
  <a href="change_t.php">แก้ไขข้อมูลส่วนตัว</a>
</div>
<div id="box">
  <img src="avatar.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["nameof"];
?></H2>
<a href="logout.php" style="color:white; " class='btn btn-danger'>Log Out</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
  <h2>ยินดีต้อนรับเข้าสู่หน้าดูกิจกรรมของนักศึกษา</h2>
  <form action="" method="get" enctype="multipart/form-data">
    <input type="text" name="search" size="50px" placeholder="ชื่อนักศึกษา,สถานะ,คณะ,ชั้นปี หรือ ชื่อกิจกรรม">
    <input type="submit" value="ค้นหา" class="btn btn-primary">
</form>
  <?php
  include 'conn.php';
  $search = isset($_GET['search']) ? $_GET['search']:'';
  $_SESSION['search'] = $_GET['search'];
$stid = oci_parse($conn, "SELECT * from show_t where studentname || studentid like '%$search%' order by studentid  ");
oci_execute($stid);
?>
<table class="table table-striped" style="margin:3rem auto;">
<tr>
<th scope='col'style='text-align:center'>รหัสนักศึกษา</th>
        <th scope='col'style='text-align:center'>ชื่อนักศึกษา</th>
        <th scope='col'style='text-align:center'>คณะ</th>
        <th scope='col'style='text-align:center'>ชั้นปี</th>
        <th scope='col'style='text-align:center'>สถานะ</th>
        <th scope='col'style='text-align:center'>รหัสกิจกรรม</th>
        <th scope='col'style='text-align:center'>ชื่อกิจกรรม</th>
        <th scope='col'style='text-align:center'>คะแนน</th>
        <th scope='col'style='text-align:center'>รายงาน</th>
</tr>
<?php 
  while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    echo "<tr align='center'>";?>
    <!-- <td><a href="canvas_teach.php?id=<?php echo $row['STUDENTID']?>"><?php echo $row['STUDENTID']?></a></td> -->
    <td><?php echo $row['STUDENTID']?></td>
        <?php echo "<td>" .$row["STUDENTNAME"] .  "</td> ";
        echo "<td>" .$row["KALE"] .  "</td> ";
        echo "<td>" .$row["SCHOOLYEAR"] .  "</td> ";
        echo "<td>" .$row["S_STATUS"] .  "</td> ";
        echo "<td>" .$row["ACTIVITIESID"] .  "</td> "; 
        echo "<td>" .$row["ACTIVITIESNAME"] .  "</td> ";
        echo "<td>" .$row["SCORES"] .  "</td> ";
        ?>
        <td><a href="teacher_chart.php?id=<?php echo $row['STUDENTID']?>" class='btn btn-info'>ดูรายงาน</a></td>
        <?php
        echo "</tr>";
      }
      ?>
</table>
<?php
// include 'canvas_teach.php';
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
  // $('.view_data').click(function(){
  //   var uid=$(this).attr("id");
  //   $.ajax({
  //     url:"select.php",
  //     method:"post",
  //     data:{id:uid},
  //     success:function(data){
  //       $('#detail').html(data)
  //       $('#dataModal').modal('show');
  //     }
  //   });
  // });
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
   
</body>
</html> 
