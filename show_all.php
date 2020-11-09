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
  <a href="index_ad.php" >หน้ารวมกิจกรรม</a>
  <a href="show_all.php" style="color: #640200;
   background-color: #F5DD37;">จัดการข้อมูลพนักงาน</a>
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
  <h2>ยินดีต้อนรับเข้าสู่หน้ารายชื่อผู้ใช้ระบบ</h2>
  <form action="" method="get" enctype="multipart/form-data">
    <input type="text" name="search" size="50px" placeholder="รหัสกิจกรรม หรือ ชื่อกิจกรรม">
    <input type="submit" value="ค้นหา" class="btn btn-primary">
    <a href="add_of.php" class='btn btn-warning'>เพิ่มผู้ใช้งาน</a>
</form> 

  <?php
  include 'conn.php';
  $search = isset($_GET['search']) ? $_GET['search']:'';
// $stid = oci_parse($conn, "SELECT * FROM official o where o.idof||o.idusercat||o.nameuserof like '%$search%'");
// oci_execute($stid);
?>
<table class="table table-striped" style="margin:3rem auto;">
<tr>
<tr>
            <th>ชื่อเข้าใช้ระบบ</th>
            <th>ชื่อบุคลากร</th>
            <th>ประเภทบุคลากร</th>
            <th>ลบผู้ใช้ระบบ</th>
            
</tr>
<?php include 'conn.php';
        $sql = oci_parse($conn,"SELECT * FROM official where nameuserof like '%$search%'");
        oci_execute($sql);
        while ($row = oci_fetch_array($sql)) {
            echo "<tr>";
          echo "<td>".$row['IDOF']."</td>";
          echo "<td>".$row['NAMEUSEROF']."</td>";
          if($row['IDUSERCAT']==2){
            echo "<td>อาจารย์</td>";
          }elseif($row['IDUSERCAT']==3){
            echo "<td>บุคลากรคณะ</td>";
          }elseif($row['IDUSERCAT']==4){
            echo "<td>บุคลากรกองพัฒฯ</td>";
          }elseif($row['IDUSERCAT']==5){
            echo "<td>ผู้ดูแลระบบ</td>";
          }?>

          <td><a href="delete_of.php?id=<?php echo $row['IDOF'];?>&cat=<?php echo $row['IDUSERCAT'];?>"" class='btn btn-danger'>ลบ</a></td>
          <?php
          "</tr>";
        }
         oci_close($conn);
         ?>
         <?php include 'conn.php';
        $sql = oci_parse($conn,"SELECT * FROM students where studentname like '%$search%'");
        oci_execute($sql);
        while ($row = oci_fetch_array($sql)) {
            echo "<tr>";
          echo "<td>".$row['STUDENTID']."</td>";
          echo "<td>".$row['STUDENTNAME']."</td>";
          if($row['IDUSERCAT']==2){
            echo "<td>อาจารย์</td>";
          }elseif($row['IDUSERCAT']==3){
            echo "<td>บุคลากรคณะ</td>";
          }elseif($row['IDUSERCAT']==4){
            echo "<td>บุคลากรกองพัฒฯ</td>";
          }elseif($row['IDUSERCAT']==5){
            echo "<td>ผู้ดูแลระบบ</td>";
          }else{
            echo "<td>นักศึกษา</td>";
          }
          ?>
          <td><a href="delete_of.php?id=<?php echo $row['STUDENTID'];?>&cat=<?php echo $row['IDUSERCAT'];?>"" class='btn btn-danger'>ลบ</a></td>
          <?php
          "</tr>";
        }
         oci_close($conn);
         ?>
</table>

<?php
// oci_free_statement($stid);
include 'admin_chart.php';
oci_close($conn);

?>
  <div style="tranform:translate(50%,50%); margin-left:46.5%;">
<!-- <a href="pdfStudent.php" class="btn btn-success" style="float:left; margin-right:10px;">Download PDF</a> -->
<form method="post" action="export_admin.php">
<a href="pdf_ad.php" class="btn btn-success" style="float:left; margin-right:10px;">Download PDF</a>
     <input type="submit" name="export" class="btn btn-success" value="Save to excel" />
    </form>
</div>

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
      url:"fetch_kana.php",
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
