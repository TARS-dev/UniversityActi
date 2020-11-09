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
  <a href="index_ad.php" >หน้ารวมกิจกรรม</a>
  <a href="show_all.php" style="color: #640200;
   background-color: #F5DD37;">จัดการข้อมูลพนักงาน</a>
   <a href="add_st.php">เพิ่มนักศึกษา</a>
  <a href="#">รายงานผู้ใช้งาน</a>
</div>
<div id="box">
  <img src="father.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["nameof"];
?></H2>
<a href="logout.php" style="color:white; " class='btn btn-danger'>Log Out</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
  
<div class="container">
<h2 style='color:green; background-color:#eccd71;'>เพิ่มข้อมูลผู้ใช้</h2>
<form action="add_addof.php" method="post">
        <label>ชื่อเข้าใช้งาน</label>
        <input type="text" name="idof" class='form-control'><br>
        <label>ประเภทผู้ใช้งาน</label>
        <select name="type" id="type" class='form-control'>
          <option value="2">อาจารย์</option>
          <option value="3">บุคลากรคณะ</option>
          <option value="4">บุคลากรกองพัฒฯ</option>
          <option value="5">ผู้ดูแลระบบ</option>
        </select><br>
        <label>ชื่อผู้ใช้งาน</label>
        <input type="text" name='name' class='form-control'><br>
        <label>รหัสผ่าน</label>
        <input type="password" name="pass" id="pass" class='form-control'><br>
        <div style='position:relative; margin-left:45%;'>
            <input type="submit" value="ตกลง">
            <input type="reset" value="ยกเลิก">
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
