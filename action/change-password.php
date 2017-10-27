<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

$btn_save=$_POST['btn_change_pass'];
date_default_timezone_set('Asia/Jakarta');
if (isset($btn_save)) {

  $kode     =$_SESSION['kode'];
  $old_pass =$_POST['old_pass'];
  $password =$_POST['password'];
  $password2=$_POST['password2'];
  $link     =$_POST['link'];

  $md5_password=md5($old_pass);
  $new_password=md5($password);

  $cek=$conn->query("select kode, passwd from otenuser where kode='$kode' and passwd='$md5_password'")->fetch();

  if ($cek[0]==false) {

    $_SESSION['success']=2;
    header("location:../dashboard/$link");
    //header("location:../dashboard/member.php?6395214e8e018ee999140ed8f9a794dfd6f00c2062bf8aa477535c4ae459b986");

  }else{


    $change=$conn->query("update otenuser set passwd='$new_password' where kode='$kode'");
    $_SESSION['success']=1;
    header("location:../dashboard/$link");
    //header("location:../dashboard/member.php?6395214e8e018ee999140ed8f9a794dfd6f00c2062bf8aa477535c4ae459b986");

  }

}else{
	header("location:../error/403.php");
}

 ?>
