<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';
require_once 'function/class.office.php';
$office = new office();
date_default_timezone_set('Asia/Jakarta');
if ($_POST['no_ship']) {


$no_shipment =$_POST['no_ship'];
$bl 		 =$_POST['bl'];

$tglbl 		 =$_POST['tglbl'];
$exp_tglbl 	 =explode("/", $tglbl);
$tgl 		 =$exp_tglbl[2]."-".$exp_tglbl[1]."-".$exp_tglbl[0];
$tanggal 	 =date("Y-m-d");
$tanggal_indo=date("d/m/Y H:i:s");

$wins_used		=$_POST['wins_used'];
$id_comp		=$_POST['id_comp'];
$item_qty		=$_POST['item_qty'];
$pic			=$_POST['pic'];
$destination	=$_POST['destination'];
$note 			=$_POST['note'];
$c_code 		=$_POST['c_code'];
$relation = $_POST['relation'];
$kode=$_SESSION['kode'];

$waktu=date("His");

$company=$conn->query("select name from t4t_participant where id='$id_comp'")->fetch();

$cek_no_bl=$conn->query("select bl from t4t_shipment where no_shipment='$no_shipment' ")->fetch();

$cek_status_bl=$conn->query("select bl from t4t_shipment where bl='$bl'")->fetch();


	if ($cek_no_bl[0]==$bl or $cek_status_bl[0]==false) {

		//insert shipment
		# no - no ship - id_comp - bl - bl tgl - win used - win unused - wkt ship - foto - acc - no order - kota - tujuan - fee - diskon - tgl paid - acc paid - note buyer - item qty


		$maxsize = 1024 * 10000; // maksimal 200 KB (1KB = 1024 Byte)
				$bl_files=$_POST['bl_files'];
				$bl_files=$_FILES['bl_files'];
				$tmp_name=$bl_files['tmp_name'];
				$namafile=$bl_files['name'];
				$namafile2=$no_shipment.'-'.$waktu.'-'.$namafile;

				$tujuan="../../management_t4t/gbr/shipment/$namafile2";
				$target=$conn->query("select foto from t4t_shipment where no_shipment='$no_shipment'")->fetch();
				$target2="../../management_t4t/gbr/shipment/$target[0]";


				if ($namafile!="") {
				unlink($target2);//hapus file
				}
				elseif($namafile==""){
					$namafile2=$target[0];
				}


				$ukuran=$_FILES['bl_files']['size'];
				if ($ukuran<=$maxsize) {

				copy($tmp_name,$tujuan);

				$conn->query("update t4t_shipment set bl='$bl',bl_tgl='$tgl',wins_used='$wins_used',item_qty='$item_qty',kota_tujuan='$destination',note='$note',buyer='$c_code',foto='$namafile2' where no_shipment='$no_shipment'")->fetch();

					//mysql_error();

				}else{
					echo $error_max_file="max file is 200kb";
				}


		if ($error_max_file==false) {

			$id_retailer = $office->nama_relation_buyer($kode,$c_code);
			$res_id_ret  = $id_retailer->related_part;

			$conn->query("UPDATE t4t_shipment set buyer='$c_code',relation='$relation' where bl='$bl' ");
			$conn->query("UPDATE t4t_wins set id_retailer='$res_id_ret',relation='$relation' where bl='$bl' ");


			if ($_POST['order']=="") {
				#
			}else{
				#hapus order
				$conn->query("update t4t_shipment set no_order='' where no_shipment='$no_shipment'")->fetch();
			$jml_order=count($_POST['order']);
			for ($i=0; $i < $jml_order ; $i++) {

				$old_order=$conn->query("select no_order from t4t_shipment where no_shipment='$no_shipment'")->fetch();
				$old_order2=$old_order[0];
				//echo $old_order2."<br>";

				$no_order=$_POST['order'][$i];
				//echo $no_order;

				if ($old_order2=="") {
					$data_order=$no_order;
				}else{
					$data_order=$old_order2.", ".$no_order;
				}

				 $conn->query("update t4t_shipment set no_order='$data_order' where no_shipment='$no_shipment'")->fetch();

			  }
			}

			//order container
			$jml_cont=$conn->query("select count(no) from t4t_container")->fetch();
			$jml_cont[0];
			for ($i=1; $i <= $jml_cont[0] ; $i++) {
				$cont=$_POST['cont'.$i];
				// mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_shipment','$i','$cont','$tanggal')");
				$conn->query("update t4t_ordercontainer set jml='$cont' where no_order='$no_shipment' and no_cont='$i'")->fetch();
			  }
			 $no_order_get=$conn->query("select no_order from t4t_shipment where no_shipment='$no_shipment'")->fetch();
			  ################email##############
			  require '../assets/PHPMailer/PHPMailerAutoload.php';

			  $mail = new PHPMailer;
			  include 'mail/system-mail.php';


			  $mail->Subject = 'Shipment Update ['.$no_shipment.']';
			  $mail->Body    = '
			  <table align="center" width="600">

			   <tr>
			     <td bgcolor="#0b6454" align="center">
			       <br><br><h2><font color="white">Shipment Update! </font></h2>
			     </td>
			   </tr>
			   <tr align="center">
			    <td bgcolor="#fff">
			     <table align="center" class="table">
			                    <tr>
			                      <td>&nbsp;</td>
			                      <td>&nbsp;</td>
			                      <td>&nbsp;</td>
			                    </tr>
			                    <tr>
			                      <td><b>Shipment No.</td>
			                      <td>:</td>
			                      <td>'.$no_shipment.'</td>
			                    </tr>
			                    <tr>
			                      <td><b>Member</td>
			                      <td>:</td>
			                      <td>'.$company[0].'</td>
			                    </tr>
			                    <tr class="active" >
			                      <td><b>BL No.</td>
			                      <td>:</td>
			                      <td>'. $bl.'</td>
			                    </tr>
			                    <tr>
			                      <td><b>WINS Used</td>
			                      <td>:</td>
			                      <td>'. $wins_used.'</td>
			                    </tr>
			                    <tr class="active" >
			                      <td><b>Update Time</td>
			                      <td>:</td>
			                      <td>'. $tanggal_indo.'</td>
			                    </tr>
			                    <tr>
			                      <td><b>Order No.</td>
			                      <td>:</td>
			                      <td>'. $no_order_get[0].'</td>
			                    </tr>
			                    <tr>
			                      <td><b>Item Qty</td>
			                      <td>:</td>
			                      <td>'. $item_qty.'</td>
			                    </tr>

			                    <br>
			                </table>
			                <br><br>
			    </td>
			   </tr>
			   <tr>
			    <td bgcolor="#0b6454" align="center">
			    <br>

			    <font color="#fff" size="0.5">&copy; '.date("Y").' Trees4Trees&trade; </font>
			    <br><br>
			    </td>
			   </tr>
			  </table>
			  ';
			  $mail->AltBody = '';

			  if(!$mail->send()) {
			      echo 'Message could not be sent.';
			      echo 'Mailer Error: ' . $mail->ErrorInfo;
			  } else {
			      echo 'Message has been sent';
			  }
			  ###############end mail############

			$_SESSION['success']=1; //sukses
			header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3db7558c18581a6d9e2dd1cb4ad7ffeb21");
			$_SESSION['no_shipment']=$no_shipment;
		}else{
			$_SESSION['success']=2; //eror maks file 200 kb.
			header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3db7558c18581a6d9e2dd1cb4ad7ffeb21");
		}

	}//end if cek bl
	else{
		$_SESSION['success']=3; //eror bl sudah ada dan beda dari awal.
		header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3db7558c18581a6d9e2dd1cb4ad7ffeb21");
	}
}else{
	header("location:../error/403.php");
}





 ?>
