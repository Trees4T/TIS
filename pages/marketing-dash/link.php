<?php
ob_start();
session_start();
if (isset($_POST['datetop'])) {
  echo $_SESSION['top5contrib']=$_POST['datetop'];
}elseif (isset($_POST['datetop8'])) {
  echo $_SESSION['date8']=$_POST['datetop8'];
}if (isset($_POST['datetop9'])) {
  echo $_SESSION['date9']=$_POST['datetop9'];
}if (isset($_POST['datetop10'])) {
  echo $_SESSION['date10']=$_POST['datetop10'];
}if (isset($_POST['datetop6'])) {
  echo $_SESSION['date6']=$_POST['datetop6'];
}if (isset($_POST['datetop7'])) {
  echo $_SESSION['date7']=$_POST['datetop7'];
}if (isset($_POST['datetop11'])) {
  echo $_SESSION['date11']=$_POST['datetop11'];
}if (isset($_POST['datetop12'])) {
  echo $_SESSION['date12']=$_POST['datetop12'];
}

header("location:../?e0e5ffbe8899949dca88b021319030b3c2da5ecf98f8bf0898e8ee0251ad56d0");
?>
