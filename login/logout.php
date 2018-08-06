<?php
session_start();
unset($_SESSION['level']);
unset($_SESSION['username']);
unset($_SESSION['kode']);
unset($_SESSION['top5contrib']);
unset($_SESSION['date8']);
unset($_SESSION['date9']);
unset($_SESSION['date10']);
unset($_SESSION['date6']);
unset($_SESSION['date7']);
unset($_SESSION['date11']);

// session_destroy();

header('location:../login/');

?>
