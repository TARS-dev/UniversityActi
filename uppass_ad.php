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
  <a href="show_all.php">จัดการข้อมูลพนักงาน</a>
  <a href="add_st.php">เพิ่มนักศึกษา</a>
  <a href="uppass_ad.php" style="color: #640200;
   background-color: #F5DD37;">แก้ไขรหัสผ่าน</a>
</div>
<div id="box">
  <img src="avatar.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["nameof"];
  $idd = $_SESSION["user"];
?></H2>
<a href="logout.php" style="color:white; " class='btn btn-danger'>Log Out</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
  
  <?php
  include 'conn.php';
// $stid = oci_parse($conn, "SELECT * FROM official where idof = $idd");
// oci_execute($stid);
// while (($row = oci_fetch_array($stid, OCI_NUM)) != false) {
// ?>
<div class="container">
<h2>แก้ไขรหัสผ่าน</h2>
    <form action="update_passkana.php" method="post">
        <label>รหัสผ่านเดิม</label>
        <input type="text" style="text-align: center;"name="old" id="" value="" class="form-control" required>
        <label>รหัสผ่านใหม่</label>
        <input type="password" style="text-align: center;"name="new" id="name" value="" class="form-control" required>
        <label>ยืนยันรหัสผ่านใหม่</label>
        <input type="password" style="text-align: center;"name="neww" id="name" value="" class="form-control" required>
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
