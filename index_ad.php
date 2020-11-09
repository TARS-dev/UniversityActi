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
  <a href="student_ac.php" style="color: #640200;
   background-color: #F5DD37;">หน้ารวมกิจกรรม</a>
  <a href="show_all.php">จัดการข้อมูลพนักงาน</a>
  <a href="add_st.php">เพิ่มนักศึกษา</a>
  <a href="uppass_ad.php">แก้ไขรหัสผ่าน</a>
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
    <input type="submit" value="ค้นหา" class="btn btn-primary"> -->
</form>
  <?php
  include 'conn.php';
  // $search = isset($_GET['search']) ? $_GET['search']:'';
// $stid = oci_parse($conn, "SELECT * FROM activities where activitiesname||activitiesid like '%$search%' ");
// oci_execute($stid);
?>
<table class="table table-striped" style="margin:3rem auto;">
<tr>
<tr>
            <th>รหัสประเภทกิจกรรม</th>
            <th>ประเภทกิจกรรม</th>
            <th>รหัสกิจกรรม</th>
            <th>ชื่อกิจกรรม</th>
            <th>คะแนนกิจกรรม</th>
</tr>
<?php include 'conn.php';
        $sql = oci_parse($conn,'SELECT activities.activitiesid,activitiesname,scores,activities.catid,catname FROM category,activities WHERE activities.catid = category.catid');
        oci_execute($sql);
        while ($row = oci_fetch_array($sql)) {
          echo "<tr><td>".$row['CATID']."</td>
          <td>".$row['CATNAME']."</td>
          <td>".$row['ACTIVITIESID']."</td>
          <td>".$row['ACTIVITIESNAME']."</td>
          <td>".$row['SCORES']."</td>
          
          
          ";?>  
          <!-- <td><input type="submit" name="view" value="แก้ไขกิจกรรม" class="btn btn-info edit_data" id="<?php echo $row['0'];?>"></td> -->
          <?php
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
<?php require 'insertModal.php'?>

<script>
$(document).ready(function(){
  $('#insert-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url:"co1.php",
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
      url:"fetch_in.php",
      method:"post",
      data:{id:uid},
      dataType:"json",
      success:function(data){
        $('#id').val(data.ACTIVITIESID)
        $('#name').val(data.ACTIVITIESNAME);
        $('#catname').val(data.CATNAME);
        $('#score').val(data.SCORES);
        $('#state').val(data.STATUS);
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
