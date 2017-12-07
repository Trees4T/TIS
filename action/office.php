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
	$office->insert_member($id_comp,$tipe,$comp_name,$address,$telp,$fax,$email1,$email2,$email3,$website,$director,$pic,$wood,$header,$intro,$outlet,$wkt_isi);
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
	if ($tipe=="Retailer") {
		$outlet 		= $_POST['outlet'];
	}else{
		$outlet = "";
	}
	echo $outlet;
	echo $header 		= $_POST['header'];
	echo $intro 		= $_POST['intro'];

	$office->update_member($id_comp,$comp_name,$address,$telp,$fax,$email1,$email2,$email3,$website,$director,$pic,$wood,$header,$intro,$outlet);
	$office->update_member2($id_comp,$comp_name,$address,$telp,$fax,$email1,$email2,$email3,$website,$director,$pic,$wood,$header,$intro,$outlet);

	$_SESSION['success']=2;
	header("location:../dashboard/marketing.php?66ae5d02d28f296edc7e1f575dd45c1c110a50c50cf9e27e0853169cc0b0532b");
}elseif (isset($_POST['backdoor-planting-maps'])) { //backdoor planting maps
	$office->truncate('t4t_web.planting_maps');
	$query = 'SELECT
							a.`no` AS `id_mapdata`,
							b.`id_part` AS `id_part`,
							a.`no_shipment` AS `id_shipment`,
							c.`name` AS `name`,
							a.`geo` AS `geo`,
							LEFT(a.geo,(LOCATE('E',a.geo) - 1)) AS `latitude_dms`,
							SUBSTR(a.geo,LOCATE('E',a.geo),15) AS `longitude_dms`,
							`DMS2DEC`(LEFT(a.geo,(LOCATE('E',a.geo) - 1)))  AS `latitude`,
							`DMS2DEC`(SUBSTR(a.geo,LOCATE('E',a.geo),15))  AS `longitude`,
							a.`jml_phn` AS `total_trees`,
							e.`nama_latin` AS `species`,
							a.`luas` AS `area`,
							a.`desa` AS `village`,
							a.`ta` AS `district`,
							a.`mu` AS `municipality`,
							a.`petani` AS `farmer`,
							d.`thn_tanam` AS `planting_year`

						FROM t4t_t4t.t4t_htc a
						LEFT JOIN t4t_t4t.`t4t_lahan` d
							ON a.geo=d.koordinat
						JOIN t4t_t4t.`t4t_pohon` e
							ON d.id_pohon2=e.id_pohon
						LEFT JOIN t4t_t4t.`t4t_shipment` f
							ON a.bl=f.bl
						LEFT JOIN t4t_t4t.`t4t_participant` c
							ON f.id_comp=c.id
						LEFT JOIN t4t_web.`view_winbatch` b
							ON a.no_shipment=b.win_batch
						';
	var_dump($query);
	$office->backdoor_planting_maps_insert($id_mapdata,$id_part,$id_shipment,$name,$geo,$latitude_dms,$longitude_dms,$latitude,$longitude,$total_trees,$species,$area,$village,$district,$municipality,$farmer,$planting_year);
else{
	header("location:../error/403.php");
}

 ?>
