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
  <a href="show_all.php" >จัดการข้อมูลพนักงาน</a>
   <a href="add_st.php" style="color: #640200;
   background-color: #F5DD37;">เพิ่มนักศึกษา</a>
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
  
<div class="container">
<h2 style='color:green; background-color:#eccd71;'>เพิ่มข้อมูลนักศึกษา</h2>
<form action="add_addst.php" method="post">
        <label>รหัสนักศึกษา</label>
        <input type="text" name="idof" class='form-control'><br>
        <label>ชื่อนักศึกษา</label>
        <input type="text" name='name' class='form-control'>
        <input type="hidden" name="status" value='none'><br>
        <label>รหัสผ่าน</label>
        <input type="password" name="pass" id="pass" class='form-control'><br>
        <input type="hidden" name='type' value='1'>
        <label>คณะวิชา</label>
        <select name="kale" id="kale" class='form-control'>
            <option value="IT">IT</option>
            <option value="Teacher">Teacher</option>
            <option value="Farm">Farm</option>
            <option value="Human">Human</option>
            <option value="Manage">Manage</option>
            <option value="Engineer">Engineer</option>
            <option value="tech">Sci-tech</option>
            <option value="NUR">NUR</option>
        </select>
        <input type="hidden" name="year" value='1'>
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
