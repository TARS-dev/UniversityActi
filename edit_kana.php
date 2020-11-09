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
  <a href="fac_show.php" >ข้อมูลกิจกรรมนักศึกษา</a>
   <a href="kana_ac.php">ดูข้อมูลกิจกรรม</a>
   <a href="add_kana.php" >เพิ่มกิจกรรม</a>
   <a href="edit_kana.php" style="color: #640200;
   background-color: #F5DD37;">แก้ไขกิจกรรม</a>
</div>
<div id="box">
  <img src="avatar.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["user"];
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
$stid = oci_parse($conn, "SELECT *  from activities where catid =2");
oci_execute($stid);

?>
<table class="table table-striped">
<tr>
  <th>รหัสกิจกรรม</th>
  <th>ชื่อกิจกรรม</th>
  <th>คะแนนกิจกรรม</th>
  <th>ประเภทกิจกรรม</th>
  <th>สถานะกิจกรรม</th>
  <th>รายละเอียดกิจกรรม</th>
  <th>แก้ไขกิจกรรม</th>
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
          <td><?php echo $row[4]; ?></td>
          <td><?php echo $row[5]; ?></td>
          <td align='center'><a href="update_kanapage.php?id=<?php echo $row['0'];?>" class="btn btn-info">แก้ไขกิจกรรม</a></td>  
          <td align='center'><a href="delete_kana.php?id=<?php echo $row['0'];?>" class="btn btn-danger">ลบกิจกรรม</a></td>  
          
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</body>
</html> 
