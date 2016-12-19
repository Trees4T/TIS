<?php 
include '../koneksi/koneksi.php';

$a=$_GET['bma'];
$b=$_GET['grs'];
$c=$_GET['pth'];
$d=$_GET['tgr'];

$a2=$_GET['bma2'];
$b2=$_GET['grs2'];
$c2=$_GET['pth2'];
$d2=$_GET['tgr2'];

$periode=$_GET['id_per'];
$periodeplus=$periode+1;

$update_data=mysql_query("update hasil set bima='$a',gresik='$b',putih='$c',tigaroda='$d' where triwulan='$periodeplus' ");
$update_data2=mysql_query("update hasil set bima='$a2',gresik='$b2',putih='$c2',tigaroda='$d2' where triwulan='$periode' ");




header("location:linechart.php")
 ?>