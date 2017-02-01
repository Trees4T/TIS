<?php  
// memulai session
session_start();
error_reporting(0);
include '../koneksi/koneksi.php';
if (isset($_SESSION['level']))
{
	// 
	if ($_SESSION['level'] == "part")
   {   
   }

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
//include '../layout/js.php';

?>