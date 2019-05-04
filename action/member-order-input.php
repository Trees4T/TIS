<?php
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

date_default_timezone_set('Asia/Jakarta');
if ($_POST['no_order']) {


if ($_SESSION['level']=='part') {
  $kode         = $_SESSION['kode'];
}elseif ($_SESSION['level']=='mkt') {
  $kode         = $_POST['comp'];
}

$no_order     =$_POST['no_order'];
$type_prod    =$_POST['type_prod'];
$tags         =$_POST['tags'];
$destination  =$_POST['destination'];
$pic          =$_POST['pic'];
$tanggal      =date("Y-m-d");
$tanggal_indo =date("d/m/Y H:i:s");
$last_wins    =$conn->query("SELECT FLOOR(wins) as win FROM t4t_wins where bl!='' and no_shipment!=''  order by win desc limit 1")->fetch();
$last         =$last_wins[0];
$wins1        =$last+1;
$wins2        =$last+$tags;
$company      =$conn->query("SELECT name from t4t_participant where id='$kode' ")->fetch();

//INSERT t4t_order
// # - no order - id comp - tipe prod - jml wins - kota tujuan - wkt order - # - # - wins1 - wins2 - quantity - #

$t4t_order=$conn->query("INSERT into t4t_order
(no_order,id_comp,tipe_prod,jml_wins,kota_tujuan,wkt_order,acc,acc2,wins1,wins2) values
('$no_order','$kode','$type_prod','$tags','$destination','$tanggal','0','0','0','0')");

//$t4t_order->execute();

//echo mysql_error();

//INSERT t4t_orderphn
// no - no order - no phnen2
$jumlah = count($_POST['item']);

//echo $_POST['item'][0];
for($i=0; $i < $jumlah; $i++)
{
   $pohon=$_POST['item'][$i];
    $t4t_orderphn=$conn->query("INSERT into t4t_orderphn (no_order,no_phnen2) values ('$no_order','$pohon')");
   //$t4t_orderphn->execute();
}



//INSERT t4t_orderrequest
//no - no order - no req - jml
$jml_req=$conn->query("SELECT count(no) from t4t_req")->fetch();
$jml_req[0];
for ($i=1; $i <= $jml_req[0] ; $i++) {
	$req=$_POST['req'.$i];
	$t4t_orderrequest=$conn->query("INSERT into t4t_orderrequest (no_order,no_req,jml) values ('$no_order','$i','$req')");
  //$t4t_orderrequest->execute();
}


//INSERT t4t_container
$jml_input=$_POST['forinput'];
$jml_input;
for($i=1;$i<=$jml_input;$i++)
{

$cont20 =$_POST['n20'.$i];
$cont40 =$_POST['n40'.$i];
$cont40hc =$_POST['n40hc'.$i];
$cont45	=$_POST['n45'.$i];
$cont60 =$_POST['n60'.$i];
$tgl 	=$_POST['tgl'.$i];

$tgl2=explode("-", $tgl);
$get_tgl=$tgl2[2]."-".$tgl2[1]."-".$tgl2[0];

	if ($tgl=="") {
		#
	}elseif ($cont20!="") {
		$c20=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','1','$cont20','$get_tgl')");
    $c20->execute();
	}else{
		$c20=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','1','0','$get_tgl')");
    $c20->execute();
	}

	if ($tgl=="") {
		#
	}elseif ($cont40!="") {
		$c40=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','2','$cont40','$get_tgl')");
    $c40->execute();
	}else{
		$c40=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','2','0','$get_tgl')");
    $c40->execute();
	}

	if ($tgl=="") {
		#
	}elseif ($cont40hc!="") {
		$c40hc=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','3','$cont40hc','$get_tgl')");
    $c40hc->execute();
	}else{
		$c40hc=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','3','0','$get_tgl')");
    $c40hc->execute();
	}

	if ($tgl=="") {
		#
	}elseif ($cont45!="") {
		$c45=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','4','$cont45','$get_tgl')");
    $c45->execute();
	}else{
		$c45=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','4','0','$get_tgl')");
    $c45->execute();
	}

	if ($tgl=="") {
		#
	}elseif ($cont60!="") {
		$c60=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','5','$cont60','$get_tgl')");
    $c60->execute();
	}else{
		$c60=$conn->query("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values ('$no_order','5','0','$get_tgl')");
    $c60->execute();
	}

	//INSERT t4t_orderwkt
	if ($tgl=="") {
		#
	}else{
		$t4t_orderwkt=$conn->query("INSERT into t4t_orderwkt (no_order,wkt_kirim) values ('$no_order','$get_tgl')");
    //$t4t_orderwkt->execute();
	}

}


################email##############
require '../assets/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
include 'mail/system-mail.php';

$mail->Subject = 'New Order ['.$no_order.']';
$mail->Body    = '
<table align="center" width="600">

 <tr>
   <td bgcolor="#0b6454" align="center">
     <br><br><h2><font color="white">New Order! </font></h2>
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
                    <td><b>Order No.</td>
                    <td>:</td>
                    <td>'.$no_order.'</td>
                  </tr>
                  <tr>
                    <td><b>Member</td>
                    <td>:</td>
                    <td>'.$company[0].'</td>
                  </tr>
                  <tr class="active" >
                    <td><b>Porduct Type</td>
                    <td>:</td>
                    <td>'. $type_prod.'</td>
                  </tr>
                  <tr>
                    <td><b>WINS Qty</td>
                    <td>:</td>
                    <td>'. $tags.'</td>
                  </tr>
                  <tr class="active" >
                    <td><b>Order Time</td>
                    <td>:</td>
                    <td>'. $tanggal_indo.'</td>
                  </tr>
                  <tr>
                    <td><b>Quantity</td>
                    <td>:</td>
                    <td>'. $tags.'</td>
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

$_SESSION['success']=1;
if ($_SESSION['level']=='part') {
  header("location:../dashboard/member.php?0a00deda25fea44b15316334aaed9df2b644f32672559d0c193973f519b0eaa6");
}elseif ($_SESSION['level']=='mkt') {
  header("location:../dashboard/marketing.php?0a00deda25fea44b15316334aaed9df2b644f32672559d0c193973f519b0eaa6");
}



}else{
	header("location:../error/403.php");
}

 ?>
