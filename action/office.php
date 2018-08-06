<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';
require_once '../action/function/class.office.php';
$office = new office();

date_default_timezone_set('Asia/Jakarta');


if (isset($_POST['btn_input_member']) ) { // input data partisipan baru
	echo $id_comp 	= $_POST['id_comp'];
	echo $tipe 		= $_POST['tipe'];
	echo $comp_name	= $_POST['comp_name'];
	echo $address 	= $_POST['address'];
	echo $telp 		= $_POST['telp'];
	echo $fax 		= $_POST['fax'];
	echo $email1 	= $_POST['email1'];
	echo $email2 	= $_POST['email2'];
	echo $email3 	= $_POST['email3'];
	echo $website 	= $_POST['website'];
	echo $pic		= $_POST['pic'];
	echo $director	= $_POST['director'];
	echo $wood 		= $_POST['wood'];
	if ($tipe=="Retailer") {
		echo $outlet 		= $_POST['outlet'];
	}else{
		$outlet = "";
	}
	echo $header 	= $_POST['header'];
   echo $intro 		= $_POST['intro'];
	$wkt_isi				= date("Y-m-d H:i:s");
	// $office->insert_member($id_comp,$tipe,$comp_name,$address,$telp,$fax,$email1,$email2,$email3,$website,$director,$pic,$wood,$header,$intro,$outlet,$wkt_isi);
  $office->insert_member2($id_comp,$tipe,$comp_name,$address,$telp,$fax,$email1,$email2,$email3,$website,$director,$pic,$wood,$header,$intro,$outlet,$wkt_isi);
	$_SESSION['success']=1;
	header("location:../dashboard/marketing.php?66ae5d02d28f296edc7e1f575dd45c1c110a50c50cf9e27e0853169cc0b0532b");

}elseif (isset($_POST['btn_edit_member']) ) { // ubah data member
	echo $id_comp 	= $_POST['id_comp'];
	echo $tipe 			= $_POST['tipe'];
	echo $comp_name	= $_POST['comp_name'];
	echo $address 	= $_POST['address'];
	echo $telp 			= $_POST['telp'];
	echo $fax 			= $_POST['fax'];
	echo $email1 		= $_POST['email1'];
	echo $email2 		= $_POST['email2'];
	echo $email3 		= $_POST['email3'];
	echo $website 	= $_POST['website'];
	echo $pic				= $_POST['pic'];
	echo $director	= $_POST['director'];
	echo $wood 			= $_POST['wood'];

	echo $actual_link			= $_POST['actual_link'];
	if ($tipe=="Retailer") {
		$outlet 		= $_POST['outlet'];
	}else{
		$outlet = "";
	}
	echo $outlet;
	echo $header 		= $_POST['header'];
	echo $intro 		= $_POST['intro'];

  $office->update_member2($id_comp,$comp_name,$address,$telp,$fax,$email1,$email2,$email3,$website,$director,$pic,$wood,$header,$intro,$outlet,$tipe);

	// tidak memakai krn menggunakan ajax
	$_SESSION['success']=2;

	header("location:../dashboard/marketing.php?$actual_link");

	//link add
}elseif (isset($_POST['button_link_add'])) {
	$actual_link			= $_POST['link'];
	$office->marketing_link_add($_POST['id_part'],$_POST['buyer'],$_POST['repeat_id']);
	$nama_part =$office->data_member($_POST['id_part']);
	$nama_buyer=$office->data_member($_POST['buyer']);
	$_SESSION['success']= 'link_add';
	$_SESSION['part']   = $nama_part ->name;
	$_SESSION['buyer']  = $nama_buyer->name;
	header("location:../dashboard/marketing.php?$actual_link");
}


else{
	header("location:../error/403.php");
}

 ?>
