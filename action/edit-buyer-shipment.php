<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';
require_once 'function/class.office.php';
$office = new office();

if ($_SESSION['level']=='part') {
  $level = 'member';
}elseif ($_SESSION['level']=='mkt') {
  $level = 'marketing';
}

date_default_timezone_set('Asia/Jakarta');

echo $kode     =$_SESSION['kode'];
echo $bl       = $_POST['bl'];
echo $c_code   = $_POST['c_code'];
echo $relation = $_POST['relation'];
echo $link     = $_POST['link'];

$wkt_ship = $conn->query("SELECT wkt_shipment from t4t_shipment where bl='$bl'")->fetch();

$id_retailer = $office->nama_relation_buyer($kode,$c_code);
$res_id_ret  = $id_retailer->related_part;
if ($c_code=='' && $relation==1) {
  $_SESSION['success']=6;
  $_SESSION['bl']=$bl;
 header("location:../dashboard/".$level.".php?".$link."");
}else{
  //berhasil
  $conn->query("UPDATE t4t_shipment set wkt_shipment='$wkt_ship[0]', buyer='$c_code',relation='$relation' where bl='$bl' ");
  $conn->query("UPDATE t4t_wins set id_retailer='$res_id_ret',relation='$relation' where bl='$bl' ");

   $_SESSION['success']=1;
   $_SESSION['bl']=$bl;
  header("location:../dashboard/".$level.".php?".$link."");
}

?>
