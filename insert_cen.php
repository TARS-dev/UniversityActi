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
  <a href="incen.php" >ข้อมูลรวมกิจกรรม</a>
  <a href="list.php">รายชื่อนักศึกษา</a>
  <a href="insert_cen.php" style="color: #640200;
   background-color: #F5DD37;">เพิ่มกิจกรรม</a>
  <a href="graduate.php">การจบการศึกษา</a>
  <a href="uppass_pud.php">แก้ไขรหัสผ่าน</a>

</div>
<div id="box">
  <img src="avatar.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["user"];
  // $idd = $_SESSION["studentid"];
?></H2>
<a href="logout.php" style="color:white; " class='btn btn-danger'>Log Out</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<div class="container">
<h2>เพิ่มกิจกรรม</h2>
    <form action="insert_ac_cen.php" method="post">
        <label>รหัสกิจกรรม</label>
        <input type="text" style="text-align: center;"name="act_id" id="" value="" class="form-control" required>
        <label>ชื่อกิจกรรม</label>
        <input type="text" style="text-align: center;"name="act_name" id="name" value="" class="form-control" required>
        <label>คะแนนกิจกรรม</label>
        <input type="number" style="text-align: center;"name="act_score" id="name" value="" class="form-control" required>
        <label>ประเภทกิจกรรม</label>
        <select id="cars" name="act_type" class="form-control" required>
            <option value="1">กิจกรรมส่วนกลาง</option>
            <option value="2">กิจกรรมบังคับคณะ</option>
            <option value="3">กิจกรรมเลือก</option>
        </select>
        <label>สถานะกิจกรรม</label>
        <select id="cars" name="act_sta" class="form-control" required>
            <option value="open">open</option>
            <option value="closed">closed</option>
        </select>
        <label>รายละเอียดกิจกรรม</label>
        <input type="text" name="act_de" class="form-control" required>
        <div style="margin-top:2rem;  text-align:center;"><input type="submit" id="submit" class='btn btn-success' value="ยืนยัน">
        <input type="reset" value="ยกเลิก" class='btn btn-danger'>
        </div>
    </form>
</div>

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
