<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

$btn_save=$_POST['save_setting'];
date_default_timezone_set('Asia/Jakarta');
if (isset($btn_save)) {

  $kode     =$_SESSION['kode'];
  $comp_name=$_POST['comp_name'];
  $address  =$_POST['address'];
  $telp     =$_POST['telp'];
  $fax      =$_POST['fax'];
  $email1   =$_POST['email1'];
  $email2   =$_POST['email2'];
  $email3   =$_POST['email3'];
  $website  =$_POST['website'];
  $director =$_POST['director'];
  $wood     =$_POST['wood'];
  $pic      =$_POST['pic'];


  $conn->query("update t4t_partisipan set nama='$comp_name', alamat='$address', tlp='$telp', fax='$fax', email='$email1', email2='$email2', email3='$email3', website='$website', direktur='$director', pic='$pic', prod_utama='$wood' where id='$kode'");

  $_SESSION['success']=1;
  header("location:../dashboard/member.php?e4744a4ac1300c2709b543daa52128adba8407366100d6893624739e93be6d95");


}else{
	header("location:../error/403.php");
}

 ?>
