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
  <a href="incen.php" >ข้อมูลรวมกิจกรรม</a>
   <a href="list.php" style="color: #640200;
   background-color: #F5DD37;">รายชื่อนักศึกษา</a>
  <a href="insert_cen.php">เพิ่มกิจกรรม</a>
  <a href="graduate.php">การจบการศึกษา</a>
  <a href="uppass_pud.php">แก้ไขรหัสผ่าน</a>
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
  <h2>ยินดีต้อนรับเข้าสู่หน้ากิจกรรมรวม</h2>
  <!-- <form action="" method="get" enctype="multipart/form-data">
    <input type="text" name="search" size="50px" placeholder="รหัสกิจกรรม หรือ ชื่อกิจกรรม">
    <input type="submit" value="ค้นหา" class="btn btn-primary">
</form> -->
  <?php
  include 'conn.php';
  // $search = isset($_GET['search']) ? $_GET['search']:'';
// $stid = oci_parse($conn, "SELECT * FROM activities where catid=1");
// oci_execute($stid);
?>
<table class="table table-striped" style="margin:3rem auto;">
<tr>
  <th>รหัสนักศึกษา</th>
  <th>ชื่อนักศึกษา</th>
  <th>คะแนนกิจกรรม</th>
  <th>ประเภทกิจกรรม</th>
</tr>
<?php
              include 'conn.php';
              $sql = oci_parse($conn,'SELECT s.studentid,s.studentname,c.catid,ca.catname,c.countscore
                                FROM students s,counting c,category ca
                                WHERE s.studentid = c.studentid
                                AND c.catid = ca.catid
                                AND ca.catid = 1
                                AND c.countscore > 19
                                ');
              oci_execute($sql);
              while ($row = oci_fetch_array($sql)) {
                echo "<tr><td>".$row['STUDENTID']."</td>
                    <td>".$row['STUDENTNAME']."</td>
                    <td>".$row['COUNTSCORE']."</td>
                    <td>".$row['CATNAME']."</td>
                    </tr>";
              }
              oci_close($conn);
                ?>
                <?php
                include 'conn.php';
                $sql = oci_parse($conn,'SELECT s.studentid,s.studentname,c.catid,ca.catname,c.countscore
                                  FROM students s,counting c,category ca
                                  WHERE s.studentid = c.studentid
                                  AND c.catid = ca.catid
                                  AND ca.catid = 2
                                  AND c.countscore > 39
                                 ');
                oci_execute($sql);
                while ($row = oci_fetch_array($sql)) {
                 echo "<tr><td>".$row['STUDENTID']."</td>
                     <td>".$row['STUDENTNAME']."</td>
                     <td>".$row['COUNTSCORE']."</td>
                     <td>".$row['CATNAME']."</td>
                     </tr>";
                }
                oci_close($conn);
                 ?>
                 <?php
                include 'conn.php';
                $sql = oci_parse($conn,'SELECT s.studentid,s.studentname,c.catid,ca.catname,c.countscore
                                  FROM students s,counting c,category ca
                                  WHERE s.studentid = c.studentid
                                  AND c.catid = ca.catid
                                  AND ca.catid = 3
                                  AND c.countscore > 39
                                  ');
                oci_execute($sql);
                while ($row = oci_fetch_array($sql)) {
                  echo "<tr><td>".$row['STUDENTID']."</td>
                      <td>".$row['STUDENTNAME']."</td>
                      <td>".$row['COUNTSCORE']."</td>
                      <td>".$row['CATNAME']."</td>
                      </tr>";
                }
                oci_close($conn);
              ?>
</table>

<?php
// oci_free_statement($stid);
oci_close($conn);

?>
  
</div>
<?php require 'viewModal.php' ?>
<?php require 'edit_Modal_cen.php'?>

<script>
$(document).ready(function(){
  $('#insert-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url:"co.php",
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
  $('.edit_data').click(function(){
    var uid=$(this).attr("id");
    $.ajax({
      url:"fetch.php",
      method:"post",
      data:{id:uid},
      dataType:"json",
      success:function(data){
        $('#id').val(data.ACTIVITIESID)
        $('#name').val(data.ACTIVITIESNAME);
        $('#catname').val(data.CATNAME);
        $('#score').val(data.SCORES);
        $('#de').val(data.DETAIL);
        $('#insert').val("แก้ไขกิจกรรม");
        $('#addModal').modal('show');
      
      }
    });
  });
$('.appli_data').click(function(){
    var uid=$(this).attr("id");
    $.ajax({
      url:"edit_cen.php",
      method:"post",
      data:{id:uid},
      dataType:"json",
      beforeSend:function(){
        $('#insert').val("แก้ไขกิจกรรม");
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
