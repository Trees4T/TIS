<?php
session_start();
unset($_SESSION['level']);
unset($_SESSION['username']);
unset($_SESSION['kode']);
// session_destroy();

header('location:../login/');

?>
