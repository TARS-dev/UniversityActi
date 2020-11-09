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
  <style>
    .container{
      margin : 7rem auto;
      width : 100%;
      height : auto;
    }
    .container h2{
      text-align:center;
    }
  </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="student_ac.php">หน้ารวมกิจกรรม</a>
  <a href="central_ac.php"  >กิจกรรมส่วนกลาง</a>
  <a href="faculty_ac.php" >กิจกรรมบังคับคณะ</a>
  <a href="choose_ac.php ">กิจกรรมเลือก</a>
  <a href="myData_ac.php">ข้อมูลการทำกิจกรรม</a>
  <a href="mineData.php" style="color: #640200;
   background-color: #F5DD37;">ข้อมูลส่วนตัว</a>
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
  
  <?php
  include 'conn.php';
$stid = oci_parse($conn, "SELECT * FROM students where studentid = $idd");
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_NUM)) != false) {
?>
<div class="container">
<h2>ข้อมูลส่วนตัวผู้ใช้</h2>
    <form action="upper.php" method="post">
        <label>รหัสนักศึกษา</label>
        <input type="text" style="text-align: center;"name="" id="" value="<?php echo $row['0']; ?>" class="form-control" disabled>
        <label>ชื่อนักศึกษา</label>
        <input type="text" style="text-align: center;"name="name" id="name" value="<?php echo $row['1']; ?>" class="form-control">
        <label>สถานะการศึกษา</label>
        <?php
          if($row['2']=='none'){
        ?>
          <input type="text" style="text-align: center; background-color:red; font-weight:bold; color:white;"name="name" id="name" value="<?php if($row['2']=='none'){echo "ยังไม่สำเร็จการศึกษา";}else{echo "สำเร็จการศึกษา";} ?>" class="form-control" disabled>
        <?php
          }else{
            ?>
          <input type="text" style="text-align: center; background-color:greenyellow; font-weight:bold;"name="name" id="name" value="<?php if($row['2']=='none'){echo "ยังไม่สำเร็จการศึกษา";}else{echo "สำเร็จการศึกษา";} ?>" class="form-control" disabled>
            <?php
          }
        ?>
        <div style="margin-top:2rem;  text-align:center;"><input type="submit" id="submit" class='btn btn-success' value="ยืนยัน">
        <input type="reset" value="ยกเลิก" class='btn btn-danger'>
        </div>
    </form>
</div>
<?php } ?>

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
