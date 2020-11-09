<?php
  session_start();
  unset($_SESSION["name"]);
  unset($_SESSION["pass"]);
  unset($_SESSION["user"]);
  unset($_SESSION["studentid"]);
  if($_SESSION['cat']==1){
    session_unset();
    session_destroy();
    header("Location: login.html");
  }else{
    session_unset();
    session_destroy();
    header("Location: admin_log.html");
  }
?>