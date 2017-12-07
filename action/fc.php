<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';
require_once '../action/function/class.fc.php';
$fc = new Fc();

date_default_timezone_set('Asia/Jakarta');


if (isset($_POST['btn_input_part']) ) { // input data partisipan baru
	echo $id_desa 		= $_POST['id_desa'];
	echo $no_part 		=  $_POST['no_part'];
	echo $nama		  	= $_POST['nama'];
	$ktp 			= $_POST['ktp'];
	echo $ktp2 				= str_replace("-","", $ktp);
	echo $alamat 			= $_POST['alamat'];
	echo $kel_tani 		= $_POST['kelompok_tani'];
	echo $anggota_kel = $_POST['keanggotaan_kelompok'];
	echo $j_kel 			= $_POST['jenis_kel'];
	echo $umur 				= $_POST['umur'];
	echo $profesi 		= $_POST['profesi'];
	echo $tujuan			= $_POST['tujuan'];
	echo $rencana 		= $_POST['rencana'];
	echo $persepsi 		= $_POST['persepsi'];
	echo $foto 				= $_POST['foto'];
				$tgl_lahir = $_POST['tgl_lahir'];
	$pdp_tani = $_POST['pdp_tani'];
	$pdp_tani_reprp = str_replace("Rp.","",$pdp_tani);
	$pdp_tani_rep00 = str_replace(",00","",$pdp_tani_reprp);
	echo $pdp_tani2 = str_replace(".","",$pdp_tani_rep00);

	$pdp_dagang = $_POST['pdp_dagang'];
	$pdp_dagangreprp = str_replace("Rp.","",$pdp_dagang);
	$pdp_dagangre00 = str_replace(",00","",$pdp_dagangreprp);
	echo $pdp_dagang2 = str_replace(".","",$pdp_dagangre00);

	$pdp_pegawai= $_POST['pdp_pegawai'];
	$pdp_pegawaireprp = str_replace("Rp.","",$pdp_pegawai);
	$pdp_pegawairep00 = str_replace(",00","",$pdp_pegawaireprp);
	echo $pdp_pegawai2 = str_replace(".","",$pdp_pegawairep00);

	$pdp_kebun	= $_POST['pdp_kebun'];
	$pdp_kebunreprp = str_replace("Rp.","",$pdp_kebun);
	$pdp_kebunrep00 = str_replace(",00","",$pdp_kebunreprp);
	echo $pdp_kebun2 = str_replace(".","",$pdp_kebunrep00);

	$pdp_lain		= $_POST['pdp_lain'];
	$pdp_lainreprp = str_replace("Rp.","",$pdp_lain);
	$pdp_lainrep00 = str_replace(",00","",$pdp_lainreprp);
	echo $pdp_lain2 = str_replace(".","",$pdp_lainrep00);
	$fc->insert_partisipan($no_part,$nama,$alamat,$profesi,$pdp_tani2,$pdp_dagang2,$pdp_pegawai2,$pdp_kebun2,$pdp_lain2,$persepsi,$ktp2,$id_desa,$tujuan);

	#### foto dan detail #
	$maxsize      = 1024 * 10000; // maksimal 200 KB (1KB = 1024 Byte)
	echo $foto_files     =$_POST['files'];
	$waktu = date("dmyHis");
			$foto_files =$_FILES['files'];
			$tmp_name =$foto_files['tmp_name'];
			$namafile =$foto_files['name'];
			$namafile2='Farmer-'.$id_desa.'-'.$no_part.''.$waktu;

			$tujuan_file ="../../management_t4t/gbr/poto/$namafile2";

			$ukuran=$_FILES['files']['size'];
			if ($ukuran<=$maxsize) {

				copy($tmp_name,$tujuan_file);
				$fc->insert_petani_detail($id_desa,$no_part,$namafile2,$j_kel,$tgl_lahir);

			}else{
				echo $error_max_file="max file is 200kb";
			}



}elseif (isset($_POST['btn_input_rentanam']) ) { // input data rencana tanam

	echo $kd_fc				= $_POST['kd_fc']; echo "<br>";
	echo $kd_mu				= $_POST['id_mu'];echo "<br>";
	echo $kd_ta				= $_POST['kd_ta'];echo "<br>";
	echo $id_desa			= $_POST['id_desa'];echo "<br>";
	echo $no_lahan			= $_POST['no_lahan'];echo "<br>";
	echo $kd_petani		= $_POST['kd_petani'];echo "<br>";
	echo $no_gps				= $_POST['gps'];echo "<br>";
	echo $no_doc				= $_POST['doc'];echo "<br>";
	echo $status_lahan	= $_POST['status_lahan'];echo "<br>";
	echo $id_lahan			= $_POST['id_lahan'];echo "<br>";
	echo $luas_lahan		= $_POST['luas_tanam'];echo "<br>";
	echo $id_pohon			= $_POST['id_pohon'];echo "<br>";
	echo $tutup_lahan	= $_POST['penutupan'];echo "<br>";
	echo $jml_usulan		= $_POST['usulan'];echo "<br>";

	$prov = substr($kd_ta, 0,2);
	$lahan2 = sprintf("%04d", $no_lahan);
	echo $kd_lahan		= $prov.''.$id_desa.''.$lahan2;
	$fc->insert_data_rencana_tanam($kd_fc,$kd_mu,$kd_ta,$id_desa,$no_lahan,$kd_petani,$no_gps,$no_doc,$status_lahan,$id_lahan,$luas_lahan,$id_pohon,$tutup_lahan,$jml_usulan,$kd_lahan);
}else{
	header("location:../error/403.php");
}

 ?>
