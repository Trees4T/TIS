<?php  
// memulai session
session_start();
error_reporting(0);
include '../koneksi/koneksi.php';
if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "adm")
   {
   }
   //elseif ($_SESSION['level'] == "mkt" )
   // {

   // }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else
   {
       header('location:../login/');
   }
}
if (!isset($_SESSION['level']))
{
	header('location:../login/');
}

include '../layout/header.php';
include '../layout/sidebar.php';
include '../layout/js.php';

?>
