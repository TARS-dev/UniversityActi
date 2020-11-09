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
   <a href="add_kana.php" style="color: #640200;
   background-color: #F5DD37;">เพิ่มกิจกรรม</a>
   <a href="edit_kana.php">แก้ไขกิจกรรม</a>
   <a href="">ลบกิจกรรม</a>
  <a href="change_t.php">แก้ไขข้อมูลส่วนตัว</a>
</div>
<div id="box">
  <img src="avatar.png" alt="">
  <H2>Hello : <?php
  include 'conn.php';
  session_start();
  echo $_SESSION["nameof"];
  $idd = $_SESSION["studentid"];
?></H2>
<a href="logout.php" style="color:white; " class='btn btn-danger'>Log Out</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
  
  <?php
  include 'conn.php';
  $ra = $_GET['id'];
$stid = oci_parse($conn, "SELECT * FROM activities WHERE activitiesid = '$ra' ");
oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_NUM)) != false) {
?>
<div class="container">
<h2>เพิ่มกิจกรรม</h2>
    <form action="savekana_ac.php?activitiesid=<?php echo $_GET["id"];?>" method="post">
        <label>รหัสกิจกรรม</label>
        <input type="text" style="text-align: center;"name="act_id" id="" value="<?php echo $row['0']?>" class="form-control" required disabled>
        <label>ชื่อกิจกรรม</label>
        <input type="text" style="text-align: center;"name="act_name" id="" value="<?php echo $row['1']?>" class="form-control" required>
        <label>เครดิตกิจกรรม</label>
        <input type="text" style="text-align: center;"name="score" id="" value="<?php echo $row['2']?>" class="form-control" required>
        <input type="hidden" style="text-align: center;"name="act_type" id="" value="2" class="form-control" required>
        <label>รายละเอียด</label>
        <input type="text" style="text-align: center;"name="act_detail" id="" value="<?php echo $row['5']?>" class="form-control" required>
        <label for="ac">สถานะกิจกรรม</label>
            <select id="ac" name="act_status">
                <option value="open">open</option>
                <option value="closed">closed</option>
            </select>
        
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