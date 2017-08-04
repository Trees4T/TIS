<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$cek_eror_wins = $_SESSION['eror'];

if ($cek_eror_wins==1) {
  $_SESSION['success']=4;
  header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3d8aa73c14170e5597465065c46886b4cd");
}else{

  if ($_POST['no_ship']) {


    $no_shipment =$_POST['no_ship'];
    $bl          =$_POST['bl'];

    $tglbl       =$_POST['tglbl'];
    $exp_tglbl   =explode("/", $tglbl);
    $tgl         =$exp_tglbl[2]."-".$exp_tglbl[1]."-".$exp_tglbl[0];
    $tanggal     =date("Y-m-d");
    $tanggal_indo=date("d/m/Y H:i:s");

    $wins_used	 =$_POST['wins_used'];
    $id_comp		 =$_POST['id_comp'];
    $item_qty		 =$_POST['item_qty'];
    $pic			   =$_POST['pic'];
    $destination =$_POST['destination'];
    $note 			 =$_POST['note'];
    $c_code 		 =$_POST['c_code'];
    $waktu       =date("His");

    $company=$conn->query("SELECT nama from t4t_partisipan where id='$id_comp'")->fetch();
    //insert shipment
    # no - no ship - id_comp - bl - bl tgl - win used - win unused - wkt ship - foto - acc - no order - kota - tujuan - fee - diskon - tgl paid - acc paid - note buyer - item qty



    $maxsize      = 1024 * 10000; // maksimal 200 KB (1KB = 1024 Byte)
    $bl_files     =$_POST['bl_files'];
    		$bl_files =$_FILES['bl_files'];
    		$tmp_name =$bl_files['tmp_name'];
    		$namafile =$bl_files['name'];
    		$namafile2=$no_shipment.'-'.$waktu.'-'.$namafile;

    		$tujuan   ="../../management_t4t/gbr/shipment/$namafile2";

        //cek no bl
    		$cek_bl=$conn->query("SELECT bl from t4t_shipment where bl='$bl'")->fetch();
        if ($cek_bl!="") {
          echo $error_unique_bl="BL No. has already been taken";
        }

        //cek kontainer
         if ($_POST['cont1']>=1 or $_POST['cont2']>=1 or $_POST['cont3']>=1 or $_POST['cont4']>=1 or $_POST['cont5']>=1) {
           echo $required_cont="required";
         }


    		$ukuran=$_FILES['bl_files']['size'];
    		if ($ukuran<=$maxsize && $error_unique_bl==false && $required_cont==true) {

    			copy($tmp_name,$tujuan);
    			$conn->query("INSERT into t4t_shipment
    	(no, no_shipment, id_comp, bl, bl_tgl, wins_used, wkt_shipment, foto, kota_tujuan, fee, diskon, note, buyer, item_qty) values
      ('','$no_shipment','$id_comp','$bl','$tgl','$wins_used','$tanggal','$namafile2','$destination','','','$note','$c_code','$item_qty')")->fetch();


    		}else{
    			echo $error_max_file="max file is 200kb";
    		}

    if ($error_unique_bl==true) {
        $_SESSION['success']=3; //bl error
        header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3d8aa73c14170e5597465065c46886b4cd");
    }
    elseif ($error_unique_bl==false && $required_cont==true) {

    	$jml_order=count($_POST['order']);
    	for ($i=0; $i < $jml_order ; $i++) {

    		$old_order=$conn->query("SELECT no_order from t4t_shipment where no_shipment='$no_shipment'")->fetch();
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
    		 //order container
    		 //mysql_query("update t4t_ordercontainer set no_order='$no_shipment' where no_order='$no_order'");

    	}

    	//order container
    	$jml_cont=$conn->query("SELECT count(no) from t4t_container")->fetch();
    	$jml_cont[0];
    	for ($i=1; $i <= $jml_cont[0] ; $i++) {
    		$cont=$_POST['cont'.$i];
    		$conn->query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_shipment','$i','$cont','$tanggal')")->fetch();
    	}

    	$no_order_get=$conn->query("SELECT no_order from t4t_shipment where no_shipment='$no_shipment'")->fetch();
    ################email##############
    require '../assets/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    include 'mail/system-mail.php';


    $mail->Subject = 'New Shipment ['.$no_shipment.']';
    $mail->Body    = '
    <table align="center" width="600">

     <tr>
       <td bgcolor="#0b6454" align="center">
         <br><br><h2><font color="white">New Shipment! </font></h2>
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
                        <td><b>Shipment Time</td>
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
                      <tr>
                        <td><br></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><b>Container Size</td>
                        <td>:</td>
                        <td>
                          <tr>
                            <td>20`</td>
                            <td>:</td>
                            <td>'. $_POST['cont1'] .'</td>
                          </tr>
                          <tr>
                            <td>40`</td>
                            <td>:</td>
                            <td>'. $_POST['cont2'] .'</td>
                          </tr>
                          <tr>
                            <td>40` HC</td>
                            <td>:</td>
                            <td>'. $_POST['cont3'] .'</td>
                          </tr>
                          <tr>
                            <td>45`</td>
                            <td>:</td>
                            <td>'. $_POST['cont4'] .'</td>
                          </tr>
                          <tr>
                            <td>60`</td>
                            <td>:</td>
                            <td>'. $_POST['cont5'] .'</td>
                          </tr>
                        </td>
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
    	header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3d8aa73c14170e5597465065c46886b4cd");
    }else{
    	$_SESSION['success']=2; //eror maks file 200 kb atau bl no
    	header("location:../dashboard/member.php?b2800c8a0fe2e3ef22145d600e05fb3d8aa73c14170e5597465065c46886b4cd");
    }


  }else{
  header("location:../error/403.php");
  }


}




 ?>
